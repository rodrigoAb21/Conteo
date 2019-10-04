@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ml-auto mr-auto">
                <div class="card text-center" >
                    <h2 class="mt-4">Elecciones Disponibles</h2>
                    @foreach($elecciones as $eleccion)
                        <div class="card-body">
                            <hr>
                            <br>
                            <h5 class="card-title">"{{$eleccion->nombre}}"</h5>
                            <a class="btn btn-primary"
                               href="{{url("resultados/$eleccion->id")}}">Revisar Votos</a>
                        </div>
                    @endforeach
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
