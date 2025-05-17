@extends('fe.layouts.main')
@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="fw-bold mb-4 text-center" data-aos="fade-up"><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h2>
        <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-lg-10">
                @if($keranjang && count($keranjang))
                <div class="table-responsive fade-in-up">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keranjang as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->obat->foto1 ? asset('storage/'.$item->obat->foto1) : 'https://via.placeholder.com/60x60?text=Produk' }}" class="rounded me-2" style="width:60px;height:60px;object-fit:cover;">
                                        <span>{{ $item->obat->nama_obat }}</span>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
                                <td>{{ $item->jumlah_order }}</td>
                                <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-danger btn-sm rounded-circle" title="Hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th colspan="2">
                                    Rp {{ number_format($keranjang->sum('subtotal'),0,',','.') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <a href="#" class="btn btn-success rounded-pill px-4"><i class="fas fa-credit-card me-2"></i>Checkout</a>
                </div>
                @else
                <div class="alert alert-info text-center">Keranjang belanja Anda kosong.</div>
                <div class="text-center">
                    <a href="{{ route('fe.shop') }}" class="btn btn-primary rounded-pill px-4">Belanja Sekarang</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
