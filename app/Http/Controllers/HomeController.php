<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        switch ($user->jabatan) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'apoteker':
                return redirect()->route('apoteker.dashboard');
            case 'kasir':
                return redirect()->route('kasir.dashboard');
            case 'pemilik':
                return redirect()->route('pemilik.dashboard');
            case 'kurir':
                return redirect()->route('kurir.dashboard');
            case 'karyawan':
                return redirect()->route('karyawan.dashboard');
            default:
                return redirect()->route('login');
        }
    }
}
