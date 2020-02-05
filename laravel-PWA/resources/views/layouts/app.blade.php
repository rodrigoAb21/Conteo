<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    <title>Elecciones</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{asset('material/css/all.css')}}">
    <!-- CSS Files -->
    <link href="{{asset('material/css/material-dashboard.minf066.css?v=2.1.0')}}" rel="stylesheet" />
    @laravelPWA
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <script src="{{asset('material/js/core/jquery.min.js')}}"></script>
    <script src="{{asset('material/js/core/popper.min.js')}}"></script>
    <script src="{{asset('material/js/core/bootstrap-material-design.min.js')}}"></script>
    <script src="{{asset('material/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('material/js/material-dashboard.minf066.js?v=2.1.0')}}" type="text/javascript"></script>

    <script src="{{asset('js/Chart.js/Chart.min.js')}}"></script>
    @stack('scripts')
</body>
</html>
