@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Horario: {{$horario->id}}
                    </h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre" ><b>NOMBRE</b></label>
                                    <p>{{$horario->nombre}}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre" ><b>TURNO</b></label>
                                    <p>{{$horario->turno}}</p>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <br>

                        <div class="row">

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered color-table info-table">
                                        <thead>
                                        <tr>
                                            <th>DIA</th>
                                            <th>ENTRADA</th>
                                            <th>SALIDA</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tabla">
                                        @foreach($horario->dias as $dia)
                                            <tr>
                                                <td>{{$dia->nombre}}</td>
                                                <td>{{$dia->entrada}}</td>
                                                <td>{{$dia->salida}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                        </div>

                </div>
            </div>
        </div>
    </div>



@endsection

