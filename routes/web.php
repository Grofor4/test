<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisObatController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\FeController;

// Redirect root to login or dashboard if already logged in
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->jabatan === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->jabatan === 'apoteker') {
            return redirect('/apoteker/dashboard');
        } elseif ($user->jabatan === 'kasir') {
            return redirect('/kasir/dashboard');
        } elseif ($user->jabatan === 'pemilik') {
            return redirect('/pemilik/dashboard');
        } elseif ($user->jabatan === 'kurir') {
            return redirect('/kurir/dashboard');
        } elseif ($user->jabatan === 'karyawan') {
            return redirect('/karyawan/dashboard');
        }
    }
    return redirect()->route('login');
});

// Authentication Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('login', function () {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->jabatan === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->jabatan === 'apoteker') {
                return redirect('/apoteker/dashboard');
            } elseif ($user->jabatan === 'kasir') {
                return redirect('/kasir/dashboard');
            } elseif ($user->jabatan === 'pemilik') {
                return redirect('/pemilik/dashboard');
            } elseif ($user->jabatan === 'kurir') {
                return redirect('/kurir/dashboard');
            } elseif ($user->jabatan === 'karyawan') {
                return redirect('/karyawan/dashboard');
            }
        }
        return app(LoginController::class)->showLoginForm();
    })->name('login');
    Route::post('login', function(\Illuminate\Http\Request $request) {
        $controller = app(LoginController::class);
        $response = $controller->authenticate($request);
        // Jika login sukses, redirect sesuai role
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->jabatan === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->jabatan === 'apoteker') {
                return redirect('/apoteker/dashboard');
            } elseif ($user->jabatan === 'kasir') {
                return redirect('/kasir/dashboard');
            } elseif ($user->jabatan === 'pemilik') {
                return redirect('/pemilik/dashboard');
            } elseif ($user->jabatan === 'kurir') {
                return redirect('/kurir/dashboard');
            } elseif ($user->jabatan === 'karyawan') {
                return redirect('/karyawan/dashboard');
            }
        }
        return $response;
    });
    Route::post('logout', function(\Illuminate\Http\Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// Dashboard redirect after login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protected routes with auth middleware only
Route::middleware(['auth'])->group(function () {
    // Universal dashboard route, hanya bisa diakses sesuai role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->jabatan === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->jabatan === 'apoteker') {
            return redirect('/apoteker/dashboard');
        } elseif ($user->jabatan === 'kasir') {
            return redirect('/kasir/dashboard');
        } elseif ($user->jabatan === 'pemilik') {
            return redirect('/pemilik/dashboard');
        } elseif ($user->jabatan === 'kurir') {
            return redirect('/kurir/dashboard');
        } elseif ($user->jabatan === 'karyawan') {
            return redirect('/karyawan/dashboard');
        }
        abort(403, 'Unauthorized');
    })->name('dashboard');

    // Admin only
    Route::get('/admin/dashboard', function() {
        if (Auth::user()->jabatan !== 'admin') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\AdminController::class)->index();
    })->name('admin.dashboard');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::post('/admin/users/{id}/update', [AdminController::class, 'update'])->name('admin.users.update');
    Route::post('/admin/users/{id}/delete', [AdminController::class, 'destroy'])->name('admin.users.delete');
    // Tambahkan alias agar route('admin.index') tidak error
    Route::get('/admin', function() {
        return redirect()->route('admin.dashboard');
    })->name('admin.index');

    // Apoteker only
    Route::get('/apoteker/dashboard', function() {
        if (Auth::user()->jabatan !== 'apoteker') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\ApotekerController::class)->index();
    })->name('apoteker.dashboard');

    // Kasir only
    Route::get('/kasir/dashboard', function() {
        if (Auth::user()->jabatan !== 'kasir') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\KasirController::class)->index();
    })->name('kasir.dashboard');

    // Pemilik only
    Route::get('/pemilik/dashboard', function() {
        if (Auth::user()->jabatan !== 'pemilik') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\PemilikController::class)->index();
    })->name('pemilik.dashboard');

    // Kurir only
    Route::get('/kurir/dashboard', function() {
        if (Auth::user()->jabatan !== 'kurir') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\KurirController::class)->index();
    })->name('kurir.dashboard');

    // Karyawan only
    Route::get('/karyawan/dashboard', function() {
        if (Auth::user()->jabatan !== 'karyawan') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\KaryawanController::class)->index();
    })->name('karyawan.dashboard');

    // Tambahkan route untuk jenis obat
    Route::post('/jenis-obat/store', [JenisObatController::class, 'store'])->name('jenis-obat.store');
    Route::post('/jenis-obat/{id}/update', [JenisObatController::class, 'update'])->name('jenis-obat.update');
    Route::post('/jenis-obat/{id}/delete', [JenisObatController::class, 'destroy'])->name('jenis-obat.delete');

    // Ganti route untuk tambah pembelian (submenu tambah produk)
    Route::post('/pembelian/store', [PembelianController::class, 'store'])->name('pembelian.store');
    Route::post('/pembelian/{id}/update', [PembelianController::class, 'update'])->name('pembelian.update');
    Route::post('/pembelian/{id}/delete', [PembelianController::class, 'destroy'])->name('pembelian.delete');

    Route::post('/distributor/store', [DistributorController::class, 'store'])->name('distributor.store');
    Route::post('/distributor/{id}/update', [DistributorController::class, 'update'])->name('distributor.update');
    Route::post('/distributor/{id}/delete', [DistributorController::class, 'destroy'])->name('distributor.delete');

    // Tambahkan route untuk detail pembelian (AJAX)
    Route::get('/pembelian/{id}/detail', function($id) {
        $pembelian = \App\Models\Pembelian::with(['distributor', 'detailPembelian'])->findOrFail($id);
        return response()->json([
            'pembelian' => [
                'nonota' => $pembelian->nonota,
                'tgl_pembelian' => $pembelian->tgl_pembelian,
                'total_bayar' => $pembelian->total_bayar,
                'distributor' => $pembelian->distributor->nama_distributor ?? '-',
            ],
            'detail' => $pembelian->detailPembelian->map(function($d) {
                return [
                    'nama_obat' => $d->nama_obat,
                    'jumlah_beli' => $d->jumlah_beli,
                    'harga_beli' => $d->harga_beli,
                    'subtotal' => $d->subtotal,
                ];
            }),
        ]);
    })->name('pembelian.detail');

    // Edit pembelian (GET)
    Route::get('/pembelian/{id}/edit', function($id) {
        $pembelian = \App\Models\Pembelian::with(['distributor', 'detailPembelian'])->find($id);
        $distributor = \App\Models\Distributor::all();
        if (!$pembelian) {
            return redirect()->back()->with('error', 'Data pembelian tidak ditemukan.');
        }
        return view('be.pembelian.edit', compact('pembelian', 'distributor'));
    })->name('pembelian.edit');

    // Delete pembelian (DELETE)
    Route::delete('/pembelian/{id}', function($id) {
        $pembelian = \App\Models\Pembelian::find($id);
        if (!$pembelian) {
            return redirect()->back()->with('error', 'Data pembelian tidak ditemukan.');
        }
        $pembelian->detailPembelian()->delete();
        $pembelian->delete();
        return back()->with('success', 'Pembelian berhasil dihapus');
    })->name('pembelian.delete');

    // Update pembelian (PUT)
    Route::put('/pembelian/{id}', function(\Illuminate\Http\Request $request, $id) {
        $pembelian = \App\Models\Pembelian::find($id);
        if (!$pembelian) {
            return redirect()->back()->with('error', 'Data pembelian tidak ditemukan.');
        }
        $request->validate([
            'nonota' => 'required|string|max:100',
            'tgl_pembelian' => 'required|date',
            'id_distributor' => 'required|exists:distributor,id',
            'detail_pembelian_json' => 'required|string',
        ]);
        $detailPembelian = json_decode($request->detail_pembelian_json, true);
        if(!$detailPembelian || !is_array($detailPembelian) || count($detailPembelian) == 0) {
            return back()->with('error', 'Isi minimal satu detail pembelian!');
        }
        $total_bayar = array_sum(array_column($detailPembelian, 'subtotal'));
        // Update header
        $pembelian->update([
            'nonota' => $request->nonota,
            'tgl_pembelian' => $request->tgl_pembelian,
            'total_bayar' => $total_bayar,
            'id_distributor' => $request->id_distributor,
        ]);
        // Hapus detail lama, insert baru
        $pembelian->detailPembelian()->delete();
        foreach($detailPembelian as $d) {
            \App\Models\DetailPembelian::create([
                'id_pembelian' => $pembelian->id,
                'nama_obat' => $d['nama_obat'] ?? null,
                'jumlah_beli' => $d['jumlah_beli'],
                'harga_beli' => $d['harga_beli'],
                'subtotal' => $d['subtotal'],
            ]);
        }
        return back()->with('success', 'Pembelian berhasil diupdate');
    })->name('pembelian.update');

    // Tambahkan route API untuk harga beli dan stok obat (AJAX)
    Route::get('/obat/harga-stok', [\App\Http\Controllers\ObatController::class, 'getHargaStok'])->name('obat.harga-stok');

    // Tambah route untuk tambah obat (menu Tambah Obat)
    Route::post('/obat/store', [ObatController::class, 'store'])->name('obat.store');
    Route::post('/obat/{id}/update', [ObatController::class, 'update'])->name('obat.update');
    Route::post('/obat/{id}/delete', [ObatController::class, 'destroy'])->name('obat.delete');

    // CRUD User Pelanggan
    Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::post('/pelanggan/{id}/update', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::post('/pelanggan/{id}/delete', [PelangganController::class, 'destroy'])->name('pelanggan.delete');
});

// Login & Register khusus pelanggan
Route::get('/loginpelanggan', [PelangganController::class, 'showLoginForm'])->name('loginpelanggan');
Route::post('/loginpelanggan', [PelangganController::class, 'authenticate']);
Route::get('/registerpelanggan', [PelangganController::class, 'showRegisterForm'])->name('registerpelanggan');
Route::post('/registerpelanggan', [PelangganController::class, 'register']);

// Logout pelanggan
Route::post('/logoutpelanggan', function (\Illuminate\Http\Request $request) {
    session()->forget(['pelanggan_id', 'pelanggan_nama']);
    session()->flush();
    return redirect('/')->with('success', 'Anda berhasil logout.');
})->name('logoutpelanggan');

// Frontend routes
Route::get('/', [FeController::class, 'home'])->name('fe.home');
Route::get('/about', [FeController::class, 'about'])->name('fe.about');
Route::get('/shop', function() {
    if (!session()->has('pelanggan_id')) {
        return redirect()->route('loginpelanggan')->with('error', 'Silakan login terlebih dahulu untuk belanja.');
    }
    return app(\App\Http\Controllers\FeController::class)->shop();
})->name('fe.shop');
Route::get('/hubungikami', [FeController::class, 'contact'])->name('fe.contact');
Route::get('/produk/{id}', [FeController::class, 'produkDetail'])->name('fe.produk.detail');
Route::get('/profil', [FeController::class, 'profil'])->name('fe.profil');
Route::post('/profil/update', [PelangganController::class, 'updateProfil'])->name('fe.profil.update');
Route::get('/keranjang', [FeController::class, 'keranjang'])->name('fe.keranjang');