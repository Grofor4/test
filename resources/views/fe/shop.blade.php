@extends('fe.layouts.main')
@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="fw-bold mb-4 text-center" data-aos="fade-up">Belanja Produk Kesehatan</h2>
        <div class="row g-4">
            @foreach($produk as $item)
            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="card produk-card h-100 border-0 shadow-sm">
                    <img src="{{ $item->foto1 ? asset('storage/'.$item->foto1) : 'https://via.placeholder.com/300x200?text=Produk' }}" class="card-img-top" alt="{{ $item->nama_obat }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_obat }}</h5>
                        <p class="card-text text-primary fw-bold mb-2">Rp {{ number_format($item->harga_jual,0,',','.') }}</p>
                        <a href="{{ route('fe.produk.detail', $item->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $produk->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
@endsection
