<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'SIM ORMAWA')</title>

  <!-- App favicon -->
  <link rel="shortcut icon" href="{{asset('assets\images\Logo UMPKU.png')}}">
  <!-- plugin css -->
  <link href="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
  <!-- preloader css -->
  <link rel="stylesheet" href="{{asset('assets/css/preloader.min.css')}}" type="text/css" />
  <!-- Bootstrap Css -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

  @include('partials.header')
  @include('partials.sidebar')

  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </div>
  
  @include('partials.footer')

   <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
        <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>
    <!-- apexcharts -->
        <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Plugins js-->
        <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- dashboard init -->
        <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script>feather.replace()</script>

  
</body>
</html>