<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | SIM Ormawa UMPKU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('assets/images/Logo UMPKU.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="auth-page" style="height: 100vh; overflow: hidden">
        <div class="container-fluid p-0">
            <div class="row g-0">

                {{-- LEFT LOGIN FORM --}}
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex flex-column justify-content-between p-5 pt-3">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">

                                <div class="mb-3 mt-3 text-center">
                                    <a href="{{ url('/') }}" class="d-block auth-logo">
                                        <img src="{{ asset('assets/images/logo-atas.png') }}" height="48">
                                    </a>
                                </div>

                                <div class="auth-content my-auto">
                                    <div class="text-center mt-0">
                                        <h5 class="mb-0">Login SIM Ormawa</h5>
                                        <p class="text-muted mt-2">
                                            Sistem Informasi Manajemen Organisasi Mahasiswa resmi UMPKU
                                        </p>
                                    </div>

                                    {{-- STATUS SESSION --}}
                                    @if (session('status'))
                                        <div class="alert alert-success mt-3">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    {{-- LOGIN FORM --}}
                                    <form class="needs-validation mt-3 pt-2" action="{{ route('login') }}"
                                        method="POST" novalidate>
                                        @csrf

                                        {{-- EMAIL --}}
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- PASSWORD --}}
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- REMEMBER ME --}}
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" name="remember"
                                                id="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100" type="submit">
                                                Login
                                            </button>
                                        </div>

                                        {{-- FORGOT PASSWORD --}}
                                        @if (Route::has('password.request'))
                                            <div class="text-center">
                                                <a href="{{ route('password.request') }}" class="text-muted">Lupa
                                                    password?</a>
                                            </div>
                                        @endif
                                    </form>

                                    {{-- REGISTER --}}
                                    <div class="mt-3 text-center">
                                        <p class="text-muted mb-0">
                                            Belum punya akun?
                                            <a href="{{ route('register') }}"
                                                class="text-primary fw-semibold">Daftar</a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT BANNER --}}
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>

                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-7">
                                <div class="p-0 p-sm-4 px-xl-0">

                                    <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active text-white">
                                                <h4 class="fw-medium lh-base">
                                                    Sistem terintegrasi untuk pengelolaan organisasi mahasiswa yang
                                                    lebih efektif.
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/validation.init.js') }}"></script>

</body>

</html>
