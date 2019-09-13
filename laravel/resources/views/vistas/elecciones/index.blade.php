@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Elecciones
                        <div class="float-right">
                            <a class="btn btn-success" href="{{url('admin/elecciones/create')}}">
                                <i class="fa fa-plus"></i> Nueva
                            </a>
                        </div>
                    </h3>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered color-table info-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>FECHA</th>
                                <th>TIPO</th>
                                <th>ESTADO</th>
                                <th>NRO_MESAS</th>
                                <th class="text-right">OPCIONES</th>
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
                                            <button class="btn btn-success">
                                                <i class="fa fa-angle-double-right"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('admin/elecciones/resultados/'.$eleccion->id.'/')}}">
                                            <button class="btn btn-info">
                                                <i class="fa fa-chart-pie"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('admin/elecciones/'.$eleccion->id.'/edit')}}">
                                            <button class="btn btn-warning">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger" onclick="modalEliminar('{{$eleccion -> nombre}}', '{{url('admin/elecciones/'.$eleccion -> id)}}')">
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
