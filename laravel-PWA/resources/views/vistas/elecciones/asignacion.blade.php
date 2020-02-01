@extends('layouts.index')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Asignaciones: "{{$eleccion->nombre}}"</h3>

                    <form method="POST" action="{{url("admin/elecciones/asignaciones/$eleccion->id")}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <select class="form-control selectpicker" data-style="btn btn-link" name="partido_id">
                                        @foreach($opciones as $opcion)
                                            <option value="{{$opcion->id}}">
                                                {{$opcion->sigla}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-sm">AGREGAR</button>
                                </div>
                            </div>

                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>SIGLA</th>
                                <th>COLOR</th>
                                <th class="text-right">OPCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($partidos as $partido)
                                <tr>
                                    <td>{{$loop -> iteration}}</td>
                                    <td>{{$partido -> sigla}}</td>
                                    <td style="background: {{$partido -> color}};"></td>
                                    <td class="text-right ">
                                        <a href="{{url("admin/elecciones/asignaciones/$eleccion->id/$partido->id/quitar")}}">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{url('admin/elecciones')}}">
                        <button class="btn btn-warning btn-sm">
                            <i class="fa fa-arrow-left"></i> Atras
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
