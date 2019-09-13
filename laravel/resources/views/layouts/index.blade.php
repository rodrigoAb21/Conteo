<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('plantilla/assets/images/favicon.png')}}">
    <title>Elecciones</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('plantilla/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('plantilla/material/css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('plantilla/material/css/colors/blue.css')}}" id="theme" rel="stylesheet">
    @stack('arriba')
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand ligh" href="{{url('admin')}}">
                        <!-- Logo icon -->
                        <b class="light-logo">
                            <i class="fa fa-person-booth"></i>
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                            <b class="light-logo"> Elecciones</b>
                        </span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0);"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0);"><i class="ti-menu"></i></a> </li>

                        
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i>
                                                Cerrar Sesion
                                        </a>

                                        <form id="logout-form" action="{{route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="{{ Request::is('admin/elecciones*') ? 'nav-item active' : 'nav-item' }}">
                            <a href="{{url('admin/elecciones')}}" >
                                <i class="fa fa-vote-yea"></i>
                                <span class="hide-menu"> Elecciones</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/participantes*') ? 'nav-item active' : 'nav-item' }}">
                            <a href="{{url('admin/participantes')}}" >
                                <i class="fa fa-users"></i>
                                <span class="hide-menu"> Participantes</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/paises*') ? 'nav-item active' : 'nav-item' }}">
                            <a href="{{url('admin/paises')}}" >
                                <i class="fa fa-globe-americas"></i>
                                <span class="hide-menu"> Paises</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/departamentos*') ? 'nav-item active' : 'nav-item' }}">
                            <a href="{{url('admin/departamentos')}}" >
                                <i class="fa fa-flag"></i>
                                <span class="hide-menu"> Departamentos</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/provincias*') ? 'nav-item active' : 'nav-item' }}">
                            <a href="{{url('admin/provincias')}}" >
                                <i class="fa fa-route"></i>
                                <span class="hide-menu"> Provincias</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/localidades*') ? 'nav-item active' : 'nav-item' }}">
                            <a href="{{url('admin/localidades')}}" >
                                <i class="fa fa-map-signs"></i>
                                <span class="hide-menu"> Localidades</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/recintos*') ? 'nav-item active' : 'nav-item' }}">
                            <a href="{{url('admin/recintos')}}" >
                                <i class="fa fa-school"></i>
                                <span class="hide-menu"> Recintos</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/mesas*') ? 'nav-item active' : 'nav-item' }}">
                            <a href="{{url('admin/mesas')}}" >
                                <i class="fa fa-archive"></i>
                                <span class="hide-menu"> Mesas</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                @yield('contenido')
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    <script src="{{asset('plantilla/assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('plantilla/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('plantilla/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('plantilla/material/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('plantilla/material/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('plantilla/material/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('plantilla/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('plantilla/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('plantilla/material/js/custom.js')}}"></script>
    <!-- ============================================================== -->
    <!-- Chart JS -->

    <script src="{{asset('plantilla/assets/plugins/Chart.js/Chart.min.js')}}"></script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{asset('plantilla/assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    @stack('scripts')
</body>

</html>
