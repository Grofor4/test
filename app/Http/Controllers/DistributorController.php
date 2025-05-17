<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;

class DistributorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_distributor' => 'required',
        ]);
        Distributor::create($request->only(['nama_distributor', 'telepon', 'alamat']));
        return back()->with('success', 'Distributor berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_distributor' => 'required',
        ]);
        $dist = Distributor::findOrFail($id);
        $dist->update($request->only(['nama_distributor', 'telepon', 'alamat']));
        return back()->with('success', 'Distributor berhasil diupdate');
    }

    public function destroy($id)
    {
        $dist = Distributor::findOrFail($id);
        $dist->delete();
        return back()->with('success', 'Distributor berhasil dihapus');
    }
}
