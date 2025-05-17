<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; scroll-behavior: smooth; }
        .navbar { box-shadow: 0 2px 8px rgba(0,0,0,0.04);}
        .hero { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: #fff; }
        .footer { background: #222; color: #fff; }
        .produk-card { transition: transform .3s, box-shadow .3s; }
        .produk-card:hover { transform: translateY(-8px) scale(1.03); box-shadow: 0 8px 32px rgba(38, 50, 56, 0.18);}
        .navbar-nav .nav-link.active { font-weight: bold; color: #2575fc !important; }
        .icon-btn { background: none; border: none; color: #2575fc; font-size: 1.3rem; margin-left: 10px; transition: color .2s;}
        .icon-btn:hover { color: #f7971e; }
        .profile-dropdown { min-width: 180px; }
        .fade-in-up { animation: fadeInUp .7s cubic-bezier(.39,.575,.565,1) both; }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px);}
            100% { opacity: 1; transform: none;}
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('fe.home') }}"><i class="fas fa-capsules"></i> ApotekOnline</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item"><a class="nav-link{{ request()->is('/') ? ' active' : '' }}" href="{{ route('fe.home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link{{ request()->is('about') ? ' active' : '' }}" href="{{ route('fe.about') }}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link{{ request()->is('shop') ? ' active' : '' }}" href="{{ route('fe.shop') }}">Shop</a></li>
                <li class="nav-item"><a class="nav-link{{ request()->is('hubungikami') ? ' active' : '' }}" href="{{ route('fe.contact') }}">Hubungi Kami</a></li>
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('fe.keranjang') }}" class="icon-btn position-relative" title="Keranjang">
                        <i class="fas fa-shopping-cart"></i>
                        {{-- Keranjang count --}}
                        @if(session()->has('pelanggan_id'))
                            @php
                                $cartCount = \App\Models\Keranjang::where('id_pelanggan', session('pelanggan_id'))->count();
                            @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.7rem;">{{ $cartCount }}</span>
                            @endif
                        @endif
                    </a>
                    <div class="dropdown d-inline-block">
                        <button class="icon-btn dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Profil">
                            <i class="fas fa-user-circle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="profileDropdown">
                            @if(session()->has('pelanggan_id'))
                                <li class="text-center py-2">
                                    @php
                                        $pelanggan = \App\Models\Pelanggan::find(session('pelanggan_id'));
                                    @endphp
                                    @if($pelanggan && $pelanggan->foto)
                                        <img src="{{ asset('storage/'.$pelanggan->foto) }}" alt="Foto Profil" class="rounded-circle shadow" style="width:48px;height:48px;object-fit:cover;">
                                    @else
                                        <i class="fas fa-user-circle fa-3x text-secondary"></i>
                                    @endif
                                    <div class="small mt-1">{{ $pelanggan->nama_pelanggan ?? '' }}</div>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('fe.profil') }}"><i class="fas fa-user me-2"></i>Profil Saya</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logoutpelanggan') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('loginpelanggan') }}"><i class="fas fa-sign-in-alt me-2"></i>Login Pelanggan</a></li>
                                <li><a class="dropdown-item" href="{{ route('registerpelanggan') }}"><i class="fas fa-user-plus me-2"></i>Register Akun</a></li>
                            @endif
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main>
    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @yield('content')
</main>
<footer class="footer mt-5 py-4">
    <div class="container text-center">
        <div class="mb-2">
            <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-whatsapp"></i></a>
        </div>
        <div>&copy; {{ date('Y') }} ApotekOnline. All rights reserved.</div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.onclick = function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if(target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
</script>
</body>
</html>
