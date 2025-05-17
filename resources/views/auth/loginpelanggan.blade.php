<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login - Apotek Online</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('be/assets/img/icon.ico') }}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{ asset('be/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('be/assets/css/fonts.min.css') }}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('be/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('be/assets/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('be/assets/css/demo.css') }}">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        html, body {hial
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        .login-container {
            z-index: 2;
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }
        .login-card {
            background: rgba(255,255,255,0.15);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: none; /* hilangkan garis solid */
            padding: 30px;
            animation: fadeIn 1s ease-out;
            position: relative;
            overflow: hidden;
        }
        .login-card #border-dot-canvas {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 2;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-card .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-card .logo img {
            max-width: 150px;
        }
        .login-card .card-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .login-card label,
        .login-card .form-check-label {
            color: #fff !important;
            font-weight: bold;
        }
        .login-card .form-control {
            background: rgba(255,255,255,0.25);
            border: none;
            color: #000;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .login-card .form-control:focus {
            background: rgba(255,255,255,0.35);
            color: #000;
            border: 1px solid #fff;
            box-shadow: 0 0 8px rgba(255,255,255,0.3);
        }
        .login-card .form-control::placeholder {
            color: rgba(0,0,0,0.7);
        }
        .login-card .input-group {
            position: relative;
        }
        .login-card .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            cursor: pointer;
            z-index: 3;
        }
        .login-card .btn-login {
            background: linear-gradient(90deg, #1e3c72, #2a5298);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            padding: 12px;
            margin-top: 15px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .login-card .btn-login:hover {
            background: linear-gradient(90deg, #2a5298, #1e3c72);
            box-shadow: 0 4px 15px rgba(42, 82, 152, 0.5);
            transform: translateY(-2px);
        }
        .login-card .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        .login-card .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }
        .login-card .form-check-label {
            color: #fff;
            font-size: 0.85rem;
        }
        .login-card .forgot-password {
            color: #fff;
            font-size: 0.85rem;
            text-align: center;
            display: block;
            margin-top: 15px;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        .login-card .forgot-password:hover {
            opacity: 1;
            text-decoration: underline;
        }
        .footer {
            color: #fff;
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            opacity: 0.8;
        }
        .footer a {
            color: #fff;
            text-decoration: underline;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        .footer a:hover {
            opacity: 1;
        }
        @media (max-width: 576px) {
            .login-container {
                padding: 10px;
            }
            .login-card {
                padding: 20px;
            }
            .login-card .card-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div id="particles-js"></div>
    <div class="login-container">
        <div class="login-card">
            <canvas id="border-dot-canvas"></canvas>
            <div class="logo">
                <img src="{{ asset('be/assets/img/logo.svg') }}" alt="Apotek Online Logo">
            </div>
            <div class="card-title">Welcome to Apotek Online</div>
            <form method="POST" action="{{ route('loginpelanggan') }}" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="nama_pelanggan">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" placeholder="Nama lengkap" required>
                    @error('nama_pelanggan')
                        <span class="invalid-feedback" role="alert" style="color:#fff;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert" style="color:#fff;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="katakunci">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('katakunci') is-invalid @enderror" id="katakunci" name="katakunci" placeholder="Enter your password" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        @error('katakunci')
                            <span class="invalid-feedback" role="alert" style="color:#fff;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-login btn-block">Login</button>
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif
            </form>
            <!-- Hapus/komentari script redirect berikut karena menyebabkan reload tanpa session -->
            <!--
            <script>
                // Setelah login sukses, redirect ke /dashboard
                if (window.location.search.includes('redirect=1')) {
                    window.location.href = '/dashboard';
                }
            </script>
            -->
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('be/assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/atlantis.min.js') }}"></script>

    <!-- SweetAlert -->
    <script src="{{ asset('be/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <script>
        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#ffffff' },
                shape: { type: 'circle' },
                opacity: { value: 0.5, random: true },
                size: { value: 3, random: true },
                line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.4, width: 1 },
                move: { enable: true, speed: 2, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false }
            },
            interactivity: {
                detect_on: 'canvas',
                events: { onhover: { enable: true, mode: 'grab' }, onclick: { enable: true, mode: 'push' }, resize: true },
                modes: { grab: { distance: 140, line_linked: { opacity: 1 } }, push: { particles_nb: 4 } }
            },
            retina_detect: true
        });

        // Toggle Password Visibility
        $('#togglePassword').click(function() {
            const passwordField = $('#password');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });

        // Show SweetAlert for errors
        @if ($errors->any())
            $(document).ready(function() {
                swal({
                    title: "Login Failed",
                    text: "{{ $errors->first() }}",
                    icon: "error",
                    button: "OK",
                });
            });
        @endif

        // Border animated gradient trailing line with glow
        (function() {
            const canvas = document.getElementById('border-dot-canvas');
            if (!canvas) return;
            const parent = canvas.parentElement;
            function resizeCanvas() {
                canvas.width = parent.offsetWidth;
                canvas.height = parent.offsetHeight;
            }
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            const ctx = canvas.getContext('2d');
            const speed = 0.012;
            const trailLength = 0.22;
            let t = 0;

            // Offset to move the animated line exactly on the outer border
            const OUTER_OFFSET = -2.5; // negative to move the path outward, adjust as needed

            function getBorderPoint(p) {
                // Draw path exactly on the outer edge of the box, with consistent radius for all corners
                const w = canvas.width, h = canvas.height;
                const r = 15; // fixed, same for all corners
                const x0 = OUTER_OFFSET, y0 = OUTER_OFFSET;
                const x1 = w - OUTER_OFFSET, y1 = h - OUTER_OFFSET;
                const perim = 2*(w + h - 4*r - 4*OUTER_OFFSET) + 2*Math.PI*r;
                let d = p * perim;
                // Top edge
                if (d < (w - 2*r - 2*OUTER_OFFSET)) return {x: x0 + r + d, y: y0};
                d -= (w - 2*r - 2*OUTER_OFFSET);
                // Top-right corner
                if (d < Math.PI/2*r) return {
                    x: x1 - r + Math.cos(Math.PI*1.5 + d/r)*r,
                    y: y0 + r + Math.sin(Math.PI*1.5 + d/r)*r
                };
                d -= Math.PI/2*r;
                // Right edge
                if (d < (h - 2*r - 2*OUTER_OFFSET)) return {x: x1, y: y0 + r + d};
                d -= (h - 2*r - 2*OUTER_OFFSET);
                // Bottom-right corner
                if (d < Math.PI/2*r) return {
                    x: x1 - r + Math.cos(0 + d/r)*r,
                    y: y1 - r + Math.sin(0 + d/r)*r
                };
                d -= Math.PI/2*r;
                // Bottom edge
                if (d < (w - 2*r - 2*OUTER_OFFSET)) return {x: x1 - r - d, y: y1};
                d -= (w - 2*r - 2*OUTER_OFFSET);
                // Bottom-left corner
                if (d < Math.PI/2*r) return {
                    x: x0 + r + Math.cos(Math.PI/2 + d/r)*r,
                    y: y1 - r + Math.sin(Math.PI/2 + d/r)*r
                };
                d -= Math.PI/2*r;
                // Left edge
                if (d < (h - 2*r - 2*OUTER_OFFSET)) return {x: x0, y: y1 - r - d};
                d -= (h - 2*r - 2*OUTER_OFFSET);
                // Top-left corner (same shape as other corners)
                return {
                    x: x0 + r + Math.cos(Math.PI + d/r)*r,
                    y: y0 + r + Math.sin(Math.PI + d/r)*r
                };
            }

            function draw() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                const w = canvas.width, h = canvas.height, r = 15;
                const time = Date.now() * 0.001;

                // Optional: subtle animated border glow only
                ctx.save();
                ctx.beginPath();
                ctx.moveTo(getBorderPoint(0).x, getBorderPoint(0).y);
                for (let i = 1; i <= 100; i++) {
                    const p = i / 100;
                    const pt = getBorderPoint(p);
                    ctx.lineTo(pt.x, pt.y);
                }
                ctx.closePath();
                ctx.strokeStyle = `rgba(109,213,237,${0.12 + 0.08 * Math.abs(Math.sin(time))})`;
                ctx.lineWidth = 8;
                ctx.shadowColor = "#6dd5ed";
                ctx.shadowBlur = 12;
                ctx.stroke();
                ctx.restore();
            }

            function animate() {
                t = (t + speed) % 1;
                draw();
                requestAnimationFrame(animate);
            }
            animate();
        })();
    </script>
</body>
</html>