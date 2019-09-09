@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Asignaciones</h3>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered color-table info-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>ROL</th>
                                <th>UBICACION</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($empleados as $empleado)
                                <tr>
                                    <td>{{$empleado -> id}}</td>
                                    <td>{{$empleado -> nombre}}</td>
                                    <td>{{$empleado -> rol}}</td>
                                    <td>{{$empleado -> ubicacion}}</td>
                                    <td class="text-right ">
                                        <a href="{{url('asignaciones/horarios/'.$empleado->id)}}">
                                            <button class="btn btn-info">
                                                <i class="fa fa-calendar-alt"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('asignaciones/ubicacion/'.$empleado->id)}}">
                                            <button class="btn btn-success">
                                                <i class="fa fa-building"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('asignaciones/clientes/'.$empleado->id.'/editar')}}">
                                            <button class="btn btn-warning">
                                                <i class="fa fa-user-tie"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$empleados->links('pagination.default')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

