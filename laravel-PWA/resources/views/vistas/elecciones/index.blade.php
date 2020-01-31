@extends('layouts.index')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-vote-yea fa-2x"></i>
                    </div>
                    <h3 class="card-title">Elecciones
                        <div class="float-right">
                            <a class="btn btn-info  btn-sm" href="{{url('admin/elecciones/create')}}">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th><b>ID</b></th>
                                <th><b>NOMBRE</b></th>
                                <th><b>FECHA</b></th>
                                <th><b>TIPO</b></th>
                                <th><b>ESTADO</b></th>
                                <th><b>NRO_MESAS</b></th>
                                <th class="text-right "><b>OPCIONES</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($elecciones as $eleccion)
                                <tr>
                                    <td>{{$eleccion -> id}}</td>
                                    <td>{{$eleccion -> nombre}}</td>
                                    <td>{{Carbon\Carbon::parse($eleccion -> fecha)->format('d/M/Y')}}</td>
                                    <td>{{$eleccion -> tipo}}</td>
                                    <td>{{$eleccion -> estado}}</td>
                                    <td>{{$eleccion -> mesas}}</td>
                                    <td class="text-right ">
                                        <a href="{{url('admin/elecciones/asignaciones/'.$eleccion->id.'/')}}">
                                            <button class="btn btn-success btn-sm" title="Asignacion">
                                                <i class="fa fa-angle-double-right"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('admin/elecciones/resultados/'.$eleccion->id.'/')}}">
                                            <button class="btn btn-info btn-sm" title="Resultados">
                                                <i class="fa fa-chart-pie"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('admin/elecciones/'.$eleccion->id.'/edit')}}">
                                            <button class="btn btn-warning btn-sm" title="Editar">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" onclick="modalEliminar('{{$eleccion -> nombre}}', '{{url('admin/elecciones/'.$eleccion -> id)}}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$elecciones->links('pagination.default')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('vistas.modal')
    @push('scripts')
        <script>

            function modalEliminar(nombre, url) {
                $('#modalEliminarForm').attr("action", url);
                $('#metodo').val("delete");
                $('#modalEliminarTitulo').html("Eliminar Eleccion");
                $('#modalEliminarEnunciado').html("Realmente desea eliminar la eleccion: " + nombre + "?");
                $('#modalEliminar').modal('show');
            }

        </script>

    @endpush()
@endsection
