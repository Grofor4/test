@extends('fe.layouts.main')
@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow border-0 fade-in-up">
                    <div class="card-body">
                        <h3 class="fw-bold mb-3 text-primary"><i class="fas fa-user-circle me-2"></i>Profil Pelanggan</h3>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($pelanggan)
                        <form method="POST" action="{{ route('fe.profil.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 text-center">
                                @if($pelanggan->foto)
                                    <img src="{{ asset('storage/'.$pelanggan->foto) }}" alt="Foto Profil" class="rounded-circle shadow" style="width:90px;height:90px;object-fit:cover;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($pelanggan->nama_pelanggan) }}&background=6a11cb&color=fff&size=90" alt="Foto Profil" class="rounded-circle shadow" style="width:90px;height:90px;object-fit:cover;">
                                @endif
                                <div class="mt-2">
                                    <label class="form-label mb-1">Foto Profil (opsional, jpg/png, max 2MB)</label>
                                    <input type="file" name="foto" class="form-control form-control-sm" accept="image/*">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. Telp <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $pelanggan->no_telp) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">URL KTP <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="url_ktp" class="form-control" value="{{ old('url_ktp', $pelanggan->url_ktp) }}">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat 1 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="alamat1" class="form-control" value="{{ old('alamat1', $pelanggan->alamat1) }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Kota 1 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="kota1" class="form-control" value="{{ old('kota1', $pelanggan->kota1) }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Provinsi 1 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="propinsi1" class="form-control" value="{{ old('propinsi1', $pelanggan->propinsi1) }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Kode Pos 1 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="kodepos1" class="form-control" value="{{ old('kodepos1', $pelanggan->kodepos1) }}">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat 2 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="alamat2" class="form-control" value="{{ old('alamat2', $pelanggan->alamat2) }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Kota 2 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="kota2" class="form-control" value="{{ old('kota2', $pelanggan->kota2) }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Provinsi 2 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="propinsi2" class="form-control" value="{{ old('propinsi2', $pelanggan->propinsi2) }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Kode Pos 2 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="kodepos2" class="form-control" value="{{ old('kodepos2', $pelanggan->kodepos2) }}">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat 3 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="alamat3" class="form-control" value="{{ old('alamat3', $pelanggan->alamat3) }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Kota 3 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="kota3" class="form-control" value="{{ old('kota3', $pelanggan->kota3) }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Provinsi 3 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="propinsi3" class="form-control" value="{{ old('propinsi3', $pelanggan->propinsi3) }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Kode Pos 3 <span class="text-muted">(opsional)</span></label>
                                    <input type="text" name="kodepos3" class="form-control" value="{{ old('kodepos3', $pelanggan->kodepos3) }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password Baru <span class="text-muted">(opsional, min 4 karakter)</span></label>
                                <input type="password" name="katakunci" class="form-control" placeholder="Isi jika ingin ganti password">
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary rounded-pill px-4" type="submit"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                            </div>
                        </form>
                        @else
                            <div class="alert alert-warning">Anda belum login sebagai pelanggan.</div>
                            <a href="{{ route('loginpelanggan') }}" class="btn btn-primary rounded-pill px-4">Login Pelanggan</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
<script>
    // Preview foto profil sebelum upload
    document.addEventListener('DOMContentLoaded', function() {
        const fotoInput = document.querySelector('input[name="foto"]');
        if(fotoInput) {
            fotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if(file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        const img = document.querySelector('img[alt="Foto Profil"]');
                        if(img) img.src = ev.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush
@endsection
