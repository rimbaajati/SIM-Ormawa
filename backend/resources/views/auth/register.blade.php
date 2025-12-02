<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register | SIM Ormawa UMPKU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('assets/images/Logo UMPKU.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}" />
</head>

<body>

    <div class="auth-page" style="height: 100vh; overflow: hidden">
        <div class="container-fluid p-0">
            <div class="row g-0">

                <!-- LEFT FORM -->
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex flex-column justify-content-between p-5 pt-3">

                        <div class="w-100">
                            <div class="d-flex flex-column h-100">

                                <div class="mb-3 mt-3 text-center">
                                    <a href="/" class="d-block auth-logo">
                                        <img src="{{ asset('assets/images/logo-atas.png') }}" alt=""
                                            height="48">
                                    </a>
                                </div>

                                <div class="auth-content my-auto">

                                    <div class="text-center">
                                        <h5 class="mb-0">Daftar Akun SIM Ormawa</h5>
                                        <p class="text-muted mt-2">
                                            Sistem Informasi Manajemen Organisasi Mahasiswa UMPKU.
                                        </p>
                                    </div>

                                    {{-- FORM START --}}
                                    <form method="POST" action="{{ route('register') }}" class="mt-3 pt-2">
                                        @csrf

                                        {{-- NAME --}}
                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}" placeholder="Masukkan nama" required>

                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- EMAIL --}}
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="Masukkan email" required>

                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- PASSWORD --}}
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Masukkan password" required>

                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- CONFIRM PASSWORD --}}
                                        <div class="mb-3">
                                            <label class="form-label">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Ulangi password" required>
                                        </div>

                                        <button class="btn btn-primary w-100" type="submit">
                                            Register
                                        </button>
                                    </form>
                                    {{-- FORM END --}}

                                    <div class="mt-3 text-center">
                                        <p class="text-muted mb-0">
                                            Sudah punya akun?
                                            <a href="{{ route('login') }}" class="text-primary fw-semibold">Login</a>
                                        </p>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT SIDE -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>

</body>

</html>
