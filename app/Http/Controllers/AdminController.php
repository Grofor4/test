<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JenisObat;
use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $jenis_obat = JenisObat::all();
        $distributor = Distributor::all();
        $pelanggan = \App\Models\Pelanggan::paginate(10); // Tambahkan pagination
        return view('be.admin.index', compact('users', 'jenis_obat', 'distributor', 'pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'jabatan' => 'required'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'jabatan' => 'required'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return back()->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}