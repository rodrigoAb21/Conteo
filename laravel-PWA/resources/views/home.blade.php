@extends('layouts.index')

@section('contenido')
    <div class="row">
        <div class="col-12 m-t-30">
            <div class="card-columns">

                <div class="card text-center p-3" >
                    <div class="card-body">
                        <h4 class="card-title">Elecciones</h4>
                        <p class="card-text"><i class="fa fa-vote-yea fa-3x"></i></p>
                        <a class="btn btn-info btn-block" href="{{url('admin/elecciones')}}"> Ver </a>
                    </div>
                </div>

                <div class="card text-center p-3" >
                    <div class="card-body">
                        <h4 class="card-title">Participantes</h4>
                        <p class="card-text"><i class="fa fa-users fa-3x"></i></p>
                        <a class="btn btn-info btn-block" href="{{url('admin/participantes')}}"> Ver </a>
                    </div>
                </div>


                <div class="card text-center p-3" >
                    <div class="card-body">
                        <h4 class="card-title">Paises</h4>
                        <p class="card-text"><i class="fa fa-globe-americas fa-3x"></i></p>
                        <a class="btn btn-info btn-block " href="{{url('admin/paises')}}"> Ver </a>
                    </div>
                </div>

                <div class="card text-center p-3" >
                    <div class="card-body">
                        <h4 class="card-title">Departamentos</h4>
                        <p class="card-text"><i class="fa fa-flag fa-3x"></i></p>
                        <a class="btn btn-info btn-block " href="{{url('admin/departamentos')}}"> Ver </a>
                    </div>
                </div>

                <div class="card text-center p-3" >
                    <div class="card-body">
                        <h4 class="card-title">Provincias</h4>
                        <p class="card-text"><i class="fa fa-route fa-3x"></i></p>
                        <a class="btn btn-info btn-block " href="{{url('admin/provincias')}}"> Ver </a>
                    </div>
                </div>

                <div class="card text-center p-3" >
                    <div class="card-body">
                        <h4 class="card-title">Localidades</h4>
                        <p class="card-text"><i class="fa fa-map-signs fa-3x"></i></p>
                        <a class="btn btn-info btn-block " href="{{url('admin/localidades')}}"> Ver </a>
                    </div>
                </div>

                <div class="card text-center p-3" >
                    <div class="card-body">
                        <h4 class="card-title">Recintos</h4>
                        <p class="card-text"><i class="fa fa-school fa-3x"></i></p>
                        <a class="btn btn-info btn-block" href="{{url('admin/recintos')}}"> Ver </a>
                    </div>
                </div>

                <div class="card text-center p-3" >
                    <div class="card-body">
                        <h4 class="card-title">Mesas</h4>
                        <p class="card-text"><i class="fa fa-archive fa-3x"></i></p>
                        <a class="btn btn-info btn-block" href="{{url('admin/mesas')}}"> Ver </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
