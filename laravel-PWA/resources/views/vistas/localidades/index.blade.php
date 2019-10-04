@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Localidades
                        <div class="float-right">
                            <a class="btn btn-success" href="{{url('admin/localidades/create')}}">
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
                                <th>PROVINCIA</th>
                                <th>DEPARTAMENTO</th>
                                <th>OPCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($localidades as $localidad)
                                <tr>
                                    <td>{{$localidad->id}}</td>
                                    <td>{{$localidad->nombre}}</td>
                                    <td>{{$localidad->provincia->nombre}}</td>
                                    <td>{{$localidad->provincia->departamento->nombre}}</td>
                                    <td class="text-right ">
                                        <a href="{{url('admin/localidades/'.$localidad->id.'/edit')}}">
                                            <button class="btn btn-warning">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger" onclick="modalEliminar('{{$localidad -> nombre}}', '{{url('admin/localidades/'.$localidad -> id)}}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$localidades->links('pagination.default')}}
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
                $('#modalEliminarTitulo').html("Eliminar Localidad");
                $('#modalEliminarEnunciado').html("Realmente desea eliminar la localidad: " + nombre + "?");
                $('#modalEliminar').modal('show');
            }

        </script>

    @endpush()
@endsection
