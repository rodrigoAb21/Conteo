@extends('layouts.index')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-map-marker fa-2x"></i>
                    </div>
                    <h3 class="card-title">Provincias
                        <div class="float-right">
                            <a class="btn btn-info btn-sm" href="{{url('admin/provincias/create')}}">
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
                                <th><b>DEPARTAMENTO</b></th>
                                <th class="text-right "><b>OPCIONES</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($provincias as $provincia)
                                <tr>
                                    <td>{{$provincia->id}}</td>
                                    <td>{{$provincia->nombre}}</td>
                                    <td>{{$provincia->departamento->nombre}}</td>
                                    <td class="text-right ">
                                        <a href="{{url('admin/provincias/'.$provincia->id.'/edit')}}">
                                            <button class="btn btn-warning btn-sm">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="modalEliminar('{{$provincia -> nombre}}', '{{url('admin/provincias/'.$provincia -> id)}}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$provincias->links('pagination.default')}}
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
                $('#modalEliminarTitulo').html("Eliminar Provincia");
                $('#modalEliminarEnunciado').html("Realmente desea eliminar la provincia: " + nombre + "?");
                $('#modalEliminar').modal('show');
            }

        </script>

    @endpush()
@endsection
