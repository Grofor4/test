@extends('fe.layouts.main')
@section('content')
<section class="hero py-5" data-aos="fade-up">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6 fade-in-up">
                <h1 class="display-4 fw-bold mb-3">Selamat Datang di Apotek Online</h1>
                <p class="lead mb-4">Belanja obat & produk kesehatan dengan mudah, aman, dan cepat. Dapatkan promo menarik setiap hari!</p>
                <a href="{{ route('fe.shop') }}" class="btn btn-warning btn-lg rounded-pill shadow"><i class="fas fa-shopping-cart me-2"></i>Belanja Sekarang</a>
            </div>
            <div class="col-lg-6 text-center fade-in-up" data-aos="zoom-in">
                <img src="https://images.unsplash.com/photo-1588776814546-ec7e5b1c8c1b?auto=format&fit=crop&w=600&q=80" class="img-fluid rounded shadow" alt="Apotek Online">
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold" data-aos="fade-up">Produk Unggulan</h2>
        <div class="row g-4">
            @foreach($produk_unggulan as $produk)
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card produk-card h-100 border-0 shadow-sm">
                    <img src="{{ $produk->foto1 ? asset('storage/'.$produk->foto1) : 'https://via.placeholder.com/300x200?text=Produk' }}" class="card-img-top" alt="{{ $produk->nama_obat }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produk->nama_obat }}</h5>
                        <p class="card-text text-primary fw-bold mb-2">Rp {{ number_format($produk->harga_jual,0,',','.') }}</p>
                        <a href="{{ route('fe.produk.detail', $produk->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('fe.shop') }}" class="btn btn-primary rounded-pill px-4">Lihat Semua Produk</a>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80" class="img-fluid rounded shadow" alt="Layanan Apotek">
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <h3 class="fw-bold mb-3">Kenapa Pilih ApotekOnline?</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i>Produk 100% Asli & Terpercaya</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i>Pengiriman Cepat & Aman</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i>Konsultasi Apoteker Gratis</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i>Promo & Diskon Menarik</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
