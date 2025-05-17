@extends('fe.layouts.main')
@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Hubungi Kami</h2>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Email Anda" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda..." required></textarea>
                    </div>
                    <button class="btn btn-primary rounded-pill px-4" type="submit">Kirim Pesan</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="bg-light rounded p-4 h-100">
                    <h5 class="fw-bold mb-2">Alamat Apotek</h5>
                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Jl. Sehat Selalu No. 123, Jakarta</p>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i>021-12345678</p>
                    <p class="mb-1"><i class="fas fa-envelope me-2"></i>info@apotekonline.com</p>
                    <div class="mt-3">
                        <iframe src="https://maps.google.com/maps?q=Jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="180" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
