@extends('fe.layouts.main')
@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <img src="{{ $produk->foto1 ? asset('storage/'.$produk->foto1) : 'https://via.placeholder.com/400x300?text=Produk' }}" class="img-fluid rounded shadow" alt="{{ $produk->nama_obat }}">
            </div>
            <div class="col-md-7">
                <h2 class="fw-bold">{{ $produk->nama_obat }}</h2>
                <p class="text-primary fs-4 fw-bold">Rp {{ number_format($produk->harga_jual,0,',','.') }}</p>
                <p>{{ $produk->deskripsi_obat }}</p>
                <div class="mb-3">
                    <span class="badge bg-info">Stok: {{ $produk->stok }}</span>
                </div>
                <a href="javascript:void(0)" class="btn btn-success btn-lg rounded-pill"><i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang</a>
            </div>
        </div>
    </div>
</section>
@endsection
