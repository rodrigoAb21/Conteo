<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('material/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('material/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Elecciones
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{asset('material/css/all.css')}}">
    <!-- CSS Files -->
    <link href="{{asset('material/css/material-dashboard.minf066.css?v=2.1.0')}}" rel="stylesheet" />
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="orange" data-background-color="black" data-image="{{asset('material/img/sidebar-1.jpg')}}">
        <div class="logo">
            <a href="{{url('/admin')}}" class="simple-text logo-mini">
            </a>
            <a href="{{url('/admin')}}" class="simple-text logo-normal">
                <img style="height: 65px; width: 120px" src="{{asset('material/img/logo.png')}}"/>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">

            </div>
            <ul class="nav">
                <li class="{{ Request::is('admin/elecciones*') ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="{{url('admin/elecciones')}}" >
                        <i class="fa fa-vote-yea"></i>
                        <p> Elecciones</p>
                    </a>
                </li>
                <li class="{{ Request::is('admin/partidos*') ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="{{url('admin/partidos')}}" >
                        <i class="fa fa-users"></i>
                        <p> Partidos</p>
                    </a>
                </li>
                <li class="{{ Request::is('admin/departamentos*') ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="{{url('admin/departamentos')}}" >
                        <i class="fa fa-globe-americas"></i>
                        <p> Departamentos</p>
                    </a>
                </li>
                <li class="{{ Request::is('admin/provincias*') ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="{{url('admin/provincias')}}" >
                        <i class="fa fa-map-marker"></i>
                        <p> Provincias</p>
                    </a>
                </li>
                <li class="{{ Request::is('admin/municipios*') ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="{{url('admin/municipios')}}" >
                        <i class="fa fa-map-pin"></i>
                        <p> Municipios</p>
                    </a>
                </li>
                <li class="{{ Request::is('admin/recintos*') ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="{{url('admin/recintos')}}" >
                        <i class="fa fa-hotel"></i>
                        <p> Recintos</p>
                    </a>
                </li>
                <li class="{{ Request::is('admin/mesas*') ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="{{url('admin/mesas')}}" >
                        <i class="fa fa-table"></i>
                        <p > Mesas</p>
                    </a>
                </li>





            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                            <i class="fa fa-ellipsis-v text_align-center visible-on-sidebar-regular"></i>
                            <i class="fa fa-th-list visible-on-sidebar-mini"></i>
                        </button>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <div class="navbar-form" hidden></div>
                    <ul class="navbar-nav">
                        {{--<li class="nav-item">
                            <a class="nav-link" href="{{url('config/tema')}}">
                                <i class="fa fa-palette"></i>
                                <p class="d-lg-none d-md-block">
                                    Cambiar tema
                                </p>
                            </a>
                        </li>--}}
                        @if(Auth::user()->area == 'Activos Fijos - Suministros')
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('sum')}}">
                                    <i class="fa fa-exchange-alt"></i>
                                    <p class="d-lg-none d-md-block">
                                        Cambiar vista
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{url('seg')}}">
                                    <i class="fa fa-user-shield"></i>
                                    <p class="d-lg-none d-md-block">
                                        Seguridad
                                    </p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt"></i>
                                <p class="d-lg-none d-md-block">
                                    Cerrar Sesion
                                </p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="content">
                <div class="container-fluid">
                    @yield('contenido')
                </div>
            </div>
        </div>

    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('material/js/core/jquery.min.js')}}"></script>
<script src="{{asset('material/js/core/popper.min.js')}}"></script>
<script src="{{asset('material/js/core/bootstrap-material-design.min.js')}}"></script>
<script src="{{asset('material/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset('material/js/plugins/bootstrap-selectpicker.js')}}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('material/js/plugins/jasny-bootstrap.min.js')}}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('material/js/material-dashboard.minf066.js?v=2.1.0')}}" type="text/javascript"></script>
<script src="{{asset('material/js/validador.js')}}" type="text/javascript"></script>
<script src="{{asset('js/Chart.js/Chart.min.js')}}"></script>
@stack('scripts')
</body>
</html>
