@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="pb-2">Ver Horarios Asignados: {{$empleado->nombre}}
                        <div class="float-right">
                            <a class="btn btn-success" href="{{url('asignaciones/horarios/'.$empleado->id.'/editar')}}">
                                <i class="fa fa-pen"></i> Editar
                            </a>
                        </div>
                    </h2>
                    @foreach($a_horarios as $a_horario)

                            <h4 class="pb-2">
                                Horario: {{$a_horario->horario->nombre}} -- Turno: {{$a_horario->horario->turno}}
                            </h4>


                            <div class="row">

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered color-table info-table">
                                        <thead>
                                        <tr>
                                            <th>DIA</th>
                                            <th>ENTRADA</th>
                                            <th>SALIDA</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tabla">
                                        @foreach($a_horario->horario->dias as $dia)
                                            <tr>
                                                <td>{{$dia->nombre}}</td>
                                                <td>{{$dia->entrada}}</td>
                                                <td>{{$dia->salida}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        <br>
                        <hr style="height:4px; background: #cbcfd4">
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
