@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Recintos
                        <div class="float-right">
                            <a class="btn btn-success" href="{{url('admin/recintos/create')}}">
                                <i class="fa fa-plus"></i> Nuevo
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
                                <th>LOCALIDAD</th>
                                <th>PROVINCIA</th>
                                <th>OPCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recintos as $recinto)
                                <tr>
                                    <td>{{$recinto->id}}</td>
                                    <td>{{$recinto->nombre}}</td>
                                    <td>{{$recinto->direccion}}</td>
                                    <td>{{$recinto->localidad->nombre}}</td>
                                    <td>{{$recinto->localidad->provincia->nombre}}</td>
                                    <td class="text-right ">
                                        <a href="{{url('admin/recintos/'.$recinto->id.'/edit')}}">
                                            <button class="btn btn-warning">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger" onclick="modalEliminar('{{$recinto -> nombre}}', '{{url('admin/recintos/'.$recinto -> id)}}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$recintos->links('pagination.default')}}
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
                $('#modalEliminarTitulo').html("Eliminar Recinto");
                $('#modalEliminarEnunciado').html("Realmente desea eliminar al recinto: " + nombre + "?");
                $('#modalEliminar').modal('show');
            }

        </script>

    @endpush()
@endsection
