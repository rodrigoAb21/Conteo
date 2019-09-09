@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Gestionar Ubicaciones
                        <div class="float-right">
                            <a class="btn btn-success" href="{{url('ubicaciones/create')}}">
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
                                <th>DIRECCION</th>
                                <th>TELEFONO</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ubicaciones as $ubicacion)
                                <tr>
                                    <td>{{$ubicacion -> id}}</td>
                                    <td>{{$ubicacion -> nombre}}</td>
                                    <td>{{$ubicacion -> direccion}}</td>
                                    <td>{{$ubicacion -> telefono}}</td>
                                    <td class="text-right ">
                                        <a href="{{url('ubicaciones/'.$ubicacion->id)}}">
                                            <button class="btn btn-success">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('ubicaciones/'.$ubicacion->id.'/edit')}}">
                                            <button class="btn btn-warning">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger" onclick="modalEliminar('{{$ubicacion -> nombre}}', '{{url('ubicaciones/'.$ubicacion -> id)}}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$ubicaciones->links('pagination.default')}}
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
                $('#modalEliminarTitulo').html("Eliminar Ubicaciones");
                $('#modalEliminarEnunciado').html("Realmente desea eliminar la ubicacion: " + nombre + "?");
                $('#modalEliminar').modal('show');
            }

        </script>

    @endpush()
@endsection
