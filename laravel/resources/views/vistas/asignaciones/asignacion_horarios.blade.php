@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div> <!-- end .flash-message -->
            <div class="card">
                <div class="card-body">
                    <h2 class="pb-2"> Horarios Asignados: {{$empleado->nombre}}</h2>
                    <form method="POST" action="{{url('asignaciones/horarios/'.$empleado->id.'/asignar')}}" autocomplete="off" >
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-inline">
                                       <label class="mr-2">Horario</label>
                                       <select class="form-control mr-2" name="horario_id">
                                           @foreach($horarios as $horario)
                                               <option value="{{$horario->id}}">{{$horario->nombre}} - {{$horario->turno}}</option>
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
                                <th>TURNO</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($asignados as $asignado)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$asignado->nombre}}</td>
                                    <td>{{$asignado->turno}}</td>
                                    <td class="text-right ">
                                        <button type="button" class="btn btn-danger" onclick="modalEliminar('{{$asignado -> nombre}}', '{{url('asignaciones/horarios/'.$empleado->id.'/eliminar/'.$asignado -> id)}}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <a href="{{url('asignaciones/horarios/'.$empleado->id)}}">
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
                $('#modalEliminarTitulo').html("Eliminar Horario");
                $('#modalEliminarEnunciado').html("Realmente desea eliminar el horario: " + nombre + "?");
                $('#modalEliminar').modal('show');
            }

        </script>

    @endpush()
@endsection
