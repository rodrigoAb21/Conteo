@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Mesas
                        <div class="float-right">
                            <a class="btn btn-success" href="{{url('admin/mesas/create')}}">
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
                                <th>INSCRTIOS</th>
                                <th>RECINTO</th>
                                <th>LOCALIDAD</th>
                                <th>PROVINCIA</th>
                                <th>OPCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mesas as $mesa)
                                <tr>
                                    <td>{{$mesa->id}}</td>
                                    <td>{{$mesa->nombre}}</td>
                                    <td>{{$mesa->inscritos}}</td>
                                    <td>{{$mesa->recinto->nombre}}</td>
                                    <td>{{$mesa->recinto->localidad->nombre}}</td>
                                    <td>{{$mesa->recinto->localidad->provincia->nombre}}</td>
                                    <td class="text-right ">
                                        <a href="{{url('admin/mesas/'.$mesa->id.'/edit')}}">
                                            <button class="btn btn-warning">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger" onclick="modalEliminar('{{$mesa -> nombre}}', '{{url('admin/mesas/'.$mesa -> id)}}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$mesas->links('pagination.default')}}
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
                $('#modalEliminarTitulo').html("Eliminar Mesa");
                $('#modalEliminarEnunciado').html("Realmente desea eliminar la mesa: " + nombre + "?");
                $('#modalEliminar').modal('show');
            }

        </script>

    @endpush()
@endsection
