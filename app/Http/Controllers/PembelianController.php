<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Distributor;

class PembelianController extends Controller
{
    // Tampilkan halaman tambah pembelian (jika ingin pakai controller, opsional)
    public function create()
    {
        $distributor = Distributor::all();
        $pembelian = Pembelian::with('distributor')->orderByDesc('id')->get();
        return view('be.layouts.content', compact('distributor', 'pembelian'));
    }

    // Simpan pembelian dan detail pembelian
    public function store(Request $request)
    {
        $request->validate([
            'nonota' => 'required|string|max:100',
            'tgl_pembelian' => 'required|date',
            'id_distributor' => 'required|exists:distributor,id',
            'detail_pembelian_json' => 'required|string',
            'total_bayar' => 'required|numeric|min:0'
        ]);

        $detailPembelian = json_decode($request->detail_pembelian_json, true);
        if(!$detailPembelian || !is_array($detailPembelian) || count($detailPembelian) == 0) {
            return back()->with('error', 'Isi minimal satu detail pembelian!');
        }

        // Simpan header pembelian
        $pembelian = Pembelian::create([
            'nonota' => $request->nonota,
            'tgl_pembelian' => $request->tgl_pembelian,
            'total_bayar' => $request->total_bayar,
            'id_distributor' => $request->id_distributor,
        ]);

        // Simpan detail pembelian
        foreach($detailPembelian as $d) {
            DetailPembelian::create([
                'id_pembelian' => $pembelian->id,
                'nama_obat' => $d['nama_obat'] ?? null,
                'jumlah_beli' => $d['jumlah_beli'],
                'harga_beli' => $d['harga_beli'],
                'subtotal' => $d['subtotal'],
            ]);
        }

        return back()->with('success', 'Pembelian berhasil disimpan');
    }
}
