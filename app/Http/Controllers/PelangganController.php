<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'email' => 'required|email',
            'no_telp' => 'nullable',
            'alamat1' => 'nullable',
            'kota1' => 'nullable',
            'propinsi1' => 'nullable', 
            'kodepos1' => 'nullable'
        ]);
        
        // Generate random katakunci
        $validated['katakunci'] = substr(md5(rand()), 0, 15);
        
        Pelanggan::create($validated);
        return redirect()->back()->with('success_pelanggan', 'Pelanggan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'email' => 'required|email',
            'no_telp' => 'nullable'
        ]);
        
        $pelanggan->update($validated);
        return redirect()->back()->with('success_pelanggan', 'Pelanggan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect()->back()->with('success_pelanggan', 'Pelanggan berhasil dihapus');
    }

    // Login pelanggan
    public function showLoginForm()
    {
        return view('auth.loginpelanggan');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'katakunci' => 'required',
        ]);
        
        $pelanggan = Pelanggan::whereRaw('BINARY `email` = ?', [trim($request->email)])->first();

        // Cek apakah password belum di-hash
        if ($pelanggan && strlen($pelanggan->katakunci) < 40) {
            // Password masih plain text, cek dengan string comparison
            if ($pelanggan->katakunci === $request->katakunci) {
                // Update ke bcrypt
                $pelanggan->katakunci = Hash::make($request->katakunci);
                $pelanggan->save();
                
                Session::put('pelanggan_id', $pelanggan->id);
                Session::put('pelanggan_nama', $pelanggan->nama_pelanggan);
                return redirect('/')->with('success', 'Login berhasil');
            }
        }
        // Password sudah di-hash, cek dengan Hash::check
        else if ($pelanggan && Hash::check($request->katakunci, $pelanggan->katakunci)) {
            Session::put('pelanggan_id', $pelanggan->id);  
            Session::put('pelanggan_nama', $pelanggan->nama_pelanggan);
            return redirect('/')->with('success', 'Login berhasil');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])
                     ->withInput($request->only('email'));
    }

    // Helper function to check if hash is bcrypt
    private function isBcrypt($hash) {
        return substr($hash, 0, 4) === '$2y$' || substr($hash, 0, 4) === '$2a$';
    }

    // Tambahkan method untuk mengambil data pelanggan dan tampilkan ke view dashboard/admin
    public function index()
    {
        $pelanggan = Pelanggan::all();
        // Jika ingin menampilkan di dashboard admin, pastikan juga variabel lain dikirim jika perlu
        return view('be.admin.index', [
            // ...tambahkan variabel lain jika perlu...
            'pelanggan' => $pelanggan,
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.registerpelanggan');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'no_telp' => 'nullable|string|max:30',
            'alamat1' => 'nullable|string|max:255',
            'kota1' => 'nullable|string|max:100',
            'propinsi1' => 'nullable|string|max:100',
            'kodepos1' => 'nullable|string|max:20',
            'alamat2' => 'nullable|string|max:255',
            'kota2' => 'nullable|string|max:100',
            'propinsi2' => 'nullable|string|max:100',
            'kodepos2' => 'nullable|string|max:20',
            'alamat3' => 'nullable|string|max:255',
            'kota3' => 'nullable|string|max:100',
            'propinsi3' => 'nullable|string|max:100',
            'kodepos3' => 'nullable|string|max:20',
            'url_ktp' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'katakunci' => 'required|string|min:4|max:255',
        ]);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('pelanggan', 'public');
            $validated['foto'] = $foto;
        }
        // Enkripsi password sebelum simpan
        $validated['katakunci'] = Hash::make($validated['katakunci']);
        $pelanggan = Pelanggan::create($validated);
        session(['pelanggan_id' => $pelanggan->id, 'pelanggan_nama' => $pelanggan->nama_pelanggan]);
        return redirect('/')->with('success', 'Registrasi berhasil, selamat datang!');
    }

    public function profil()
    {
        if (!session()->has('pelanggan_id')) {
            return redirect()->route('loginpelanggan')->with('error', 'Silakan login terlebih dahulu.');
        }
        $pelanggan = Pelanggan::find(session('pelanggan_id'));
        return view('fe.profil', compact('pelanggan'));
    }

    public function updateProfil(Request $request)
    {
        if (!session()->has('pelanggan_id')) {
            return redirect()->route('loginpelanggan')->with('error', 'Silakan login terlebih dahulu.');
        }
        $pelanggan = Pelanggan::findOrFail(session('pelanggan_id'));
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email,'.$pelanggan->id,
            'no_telp' => 'nullable|string|max:30',
            'alamat1' => 'nullable|string|max:255',
            'kota1' => 'nullable|string|max:100',
            'propinsi1' => 'nullable|string|max:100',
            'kodepos1' => 'nullable|string|max:20',
            'alamat2' => 'nullable|string|max:255',
            'kota2' => 'nullable|string|max:100',
            'propinsi2' => 'nullable|string|max:100',
            'kodepos2' => 'nullable|string|max:20',
            'alamat3' => 'nullable|string|max:255',
            'kota3' => 'nullable|string|max:100',
            'propinsi3' => 'nullable|string|max:100',
            'kodepos3' => 'nullable|string|max:20',
            'url_ktp' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'katakunci' => 'nullable|string|min:4|max:32',
        ]);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('pelanggan', 'public');
            $pelanggan->foto = $foto;
        }
        // Jika password diisi, enkripsi dan update
        if (!empty($validated['katakunci'])) {
            $pelanggan->katakunci = Hash::make($validated['katakunci']);
        }
        // Hapus katakunci dari array agar tidak diupdate mass-assignment
        if (array_key_exists('katakunci', $validated)) {
            unset($validated['katakunci']);
        }
        $pelanggan->update($validated);
        $pelanggan->save();
        session(['pelanggan_nama' => $pelanggan->nama_pelanggan]);
        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
