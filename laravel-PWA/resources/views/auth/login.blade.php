<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('material/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('material/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Login - INEGAS
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{asset('material/css/all.css')}}">
    <!-- CSS Files -->
    <link href="{{asset('material/css/material-dashboard.minf066.css?v=2.1.0')}}" rel="stylesheet" />
    <style>
        #fondo{
            background-size: cover;
            background-position: top center;
            background-image: url("{{asset('material/img/login2.jpg')}}");
        }
    </style>
</head>

<body class="off-canvas-sidebar">
<div class="wrapper wrapper-full-page">
    <div id="fondo" class="page-header login-page header-filter">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="card card-login">
                            <div class="card-header card-header-warning text-center">
                                <h4 class="card-title">Login</h4>
                            </div>
                            <div class="card-body ">
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-envelope"></i>
                        </span>
                      </div>
                      <input name="email" type="email" class="form-control" placeholder="Email...">
                    </div>
                  </span>
                                <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-lock"></i>
                        </span>
                      </div>
                      <input name="password" type="password" class="form-control" placeholder="Password...">
                    </div>
                  </span>
                            </div>
                            <div class="card-footer justify-content-center">
                                <button type="submit" class="btn btn-warning">Iniciar Sesion</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if($errors -> any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors -> all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('material/js/core/jquery.min.js')}}"></script>
<script src="{{asset('material/js/core/popper.min.js')}}"></script>
<script src="{{asset('material/js/core/bootstrap-material-design.min.js')}}"></script>

</body>
</html>
