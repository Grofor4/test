<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Keranjang;
use App\Models\Pelanggan;

class FeController extends Controller
{
    public function home()
    {
        $produk_unggulan = Obat::orderByDesc('id')->take(6)->get();
        return view('fe.home', compact('produk_unggulan'));
    }

    public function about()
    {
        return view('fe.about');
    }

    public function shop()
    {
        $produk = Obat::orderByDesc('id')->paginate(12);
        return view('fe.shop', compact('produk'));
    }

    public function produkDetail($id)
    {
        $produk = Obat::findOrFail($id);
        return view('fe.produk-detail', compact('produk'));
    }

    public function contact()
    {
        return view('fe.contact');
    }

    public function profil()
    {
        // Contoh: ambil data pelanggan dari session (atau auth jika sudah login pelanggan)
        $pelanggan = null;
        if (session()->has('pelanggan_id')) {
            $pelanggan = Pelanggan::find(session('pelanggan_id'));
        }
        return view('fe.profil', compact('pelanggan'));
    }

    public function keranjang()
    {
        $keranjang = [];
        if (session()->has('pelanggan_id')) {
            $keranjang = Keranjang::with('obat')->where('id_pelanggan', session('pelanggan_id'))->get();
        }
        return view('fe.keranjang', compact('keranjang'));
    }
}
