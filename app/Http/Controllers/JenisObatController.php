<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisObat;
use App\Models\Obat;
use App\Models\Distributor;

class JenisObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_obat = JenisObat::all();
        $distributor = Distributor::all();
        return view('be.layouts.content', compact('jenis_obat', 'distributor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['jenis' => 'required']);
        $data = [
            'jenis' => $request->jenis,
            'deskripsi_jenis' => $request->deskripsi_jenis,
        ];
        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('jenis-obat', 'public');
        }
        JenisObat::create($data);
        return back()->with('success', 'Jenis obat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['jenis' => 'required']);
        $jenis = JenisObat::findOrFail($id);
        $data = [
            'jenis' => $request->jenis,
            'deskripsi_jenis' => $request->deskripsi_jenis,
        ];
        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('jenis-obat', 'public');
        }
        $jenis->update($data);
        return back()->with('success', 'Jenis obat berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenis = JenisObat::findOrFail($id);
        $jenis->delete();
        return back()->with('success', 'Jenis obat berhasil dihapus');
    }
}
