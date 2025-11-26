<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Dashboard - SIM Ormawa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Dashboard SIM Ormawa" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ 'assets/images/Logo UMPKU.png' }}">
    <!-- plugin css -->
    <link rel="stylesheet" href="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- preloader css -->
    <link rel="stylesheet" href="{{asset('assets/css/preloader.min.css')}}">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ 'assets/css/bootstrap.min.css' }}" />
    <!-- Icons Css -->
    <link rel="stylesheet" href="{{ 'assets/css/icons.min.css' }}" />
    <!-- App Css-->
    <link rel="stylesheet" href="{{ 'assets/css/app.min.css' }}" />
    
</head>
    
<body>

    {{-- Header --}}
    @include('partials.header')

    <div class="wrapper">
        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Konten --}}
        <div class="content">
            @yield('content')
        </div>
    </div>

    {{-- Footer --}}
    @include('partials.footer')

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
</body>
</html>
