@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Assignaciones: "{{$eleccion->nombre}}"</h3>

                    <form method="POST" action="{{url("admin/elecciones/asignaciones/$eleccion->id")}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <select class="form-control" name="participante_id">
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
                                    <button type="submit" class="btn btn-info">AGREGAR</button>
                                </div>
                            </div>

                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered color-table info-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>SIGLA</th>
                                <th>COLOR</th>
                                <th class="text-right">OPCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($participantes as $participante)
                                <tr>
                                    <td>{{$loop -> iteration}}</td>
                                    <td>{{$participante -> sigla}}</td>
                                    <td style="background: {{$participante -> color}};"></td>
                                    <td class="text-right ">
                                        <a href="{{url("admin/elecciones/asignaciones/$eleccion->id/$participante->id/quitar")}}">
                                            <button class="btn btn-danger">
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
                        <button class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Atras
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
