@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="pb-2"> Clientes asignados: {{$empleado->nombre}}</h2>
                    <form method="POST" action="{{url('asignaciones/clientes/'.$empleado->id.'/asignar')}}" autocomplete="off" >
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-inline">
                                    <label class="mr-2">Cliente</label>
                                    <select class="form-control mr-2" name="cliente_id">
                                        @foreach($clientes as $cliente)
                                            <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-info"> <i class="fa fa-plus"></i> Agregar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered color-table info-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>DIRECCION</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($asignados as $asignado)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$asignado->cliente->nombre}}</td>
                                    <td>{{$asignado->cliente->direccion}}</td>
                                    <td class="text-right ">
                                        <a href="{{url('clientes/'.$asignado->cliente_id)}}">
                                            <button class="btn btn-success">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger" onclick="modalEliminar('{{$asignado->cliente->nombre}}', '{{url('asignaciones/clientes/'.$empleado->id.'/eliminar/'.$asignado -> id)}}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <a href="{{url('asignaciones')}}">
                            <button class="btn btn-warning">
                                <i class="fa fa-arrow-left"></i> Atras
                            </button>
                        </a>
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
                $('#modalEliminarTitulo').html("Eliminar Cliente");
                $('#modalEliminarEnunciado').html("Realmente desea eliminar el cliente: " + nombre + "?");
                $('#modalEliminar').modal('show');
            }

        </script>

    @endpush()
@endsection
