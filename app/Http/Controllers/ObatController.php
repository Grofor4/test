<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Models\Pembelian;
use App\Models\Obat;
use App\Models\DetailPembelian;
use App\Models\JenisObat;

class ObatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:100',
            'id_jenis_obat' => 'required|exists:jenis_obat,id',
            'margin' => 'required|numeric|min:0|max:100',
            'harga_jual' => 'required|numeric|min:0',
            'foto1' => 'nullable|image|max:2048',
            'foto2' => 'nullable|image|max:2048',
            'foto3' => 'nullable|image|max:2048'
        ]);

        // Get total stok from detail_pembelian
        $stok = DetailPembelian::where('nama_obat', $request->nama_obat)
            ->sum('jumlah_beli');

        $data = [
            'nama_obat' => $request->nama_obat,
            'id_jenis_obat' => $request->id_jenis_obat,
            'harga_jual' => $request->harga_jual,
            'stok' => $stok,
            'deskripsi_obat' => $request->deskripsi_obat
        ];

        // Handle photo uploads
        if ($request->hasFile('foto1')) {
            $data['foto1'] = $request->file('foto1')->store('obat', 'public');
        }
        if ($request->hasFile('foto2')) {
            $data['foto2'] = $request->file('foto2')->store('obat', 'public');
        }
        if ($request->hasFile('foto3')) {
            $data['foto3'] = $request->file('foto3')->store('obat', 'public');
        }

        // Create new obat record
        Obat::create($data);

        return back()->with('success', 'Obat berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);
        $request->validate([
            'nama_obat' => 'required|string|max:100',
            'id_jenis_obat' => 'required|exists:jenis_obat,id',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);
        $obat->nama_obat = $request->nama_obat;
        $obat->id_jenis_obat = $request->id_jenis_obat;
        $obat->harga_jual = $request->harga_jual;
        $obat->stok = $request->stok;
        $obat->deskripsi_obat = $request->deskripsi_obat;
        if ($request->hasFile('foto1')) {
            $obat->foto1 = $request->file('foto1')->store('obat', 'public');
        }
        $obat->save();
        return back()->with('success', 'Obat berhasil diupdate');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return back()->with('success', 'Obat berhasil dihapus');
    }

    // API untuk harga beli terakhir dan stok total berdasarkan nama obat
    public function getHargaStok(Request $request)
    {
        $nama = $request->query('nama_obat');
        
        // Get latest harga_beli from detail_pembelian
        $lastDetail = DetailPembelian::where('nama_obat', $nama)
            ->orderByDesc('id')
            ->first();
            
        // Get total stok from all purchases
        $totalStok = DetailPembelian::where('nama_obat', $nama)
            ->sum('jumlah_beli');
            
        // Get existing obat data if exists
        $obat = Obat::where('nama_obat', $nama)->first();

        return response()->json([
            'harga_beli' => $lastDetail ? $lastDetail->harga_beli : 0,
            'stok' => $totalStok,
            'id_jenis_obat' => $obat ? $obat->id_jenis_obat : null
        ]);
    }
}
