<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('plantilla/assets/images/favicon.png')}}">
    <title>Elecciones</title>

    <!-- Styles -->
    <link href="{{asset('plantilla/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    @laravelPWA
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{asset('plantilla/assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('plantilla/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('plantilla/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('plantilla/assets/plugins/Chart.js/Chart.min.js')}}"></script>
    @stack('scripts')
</body>
</html>
