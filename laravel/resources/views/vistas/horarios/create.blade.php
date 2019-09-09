@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Nuevo Horario
                    </h3>

                    <form method="POST" action="{{url('horarios')}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre" >Nombre</label>
                                    <input required type="text" name="nombre" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre" >Turnos</label>
                                    <select class="form-control" name="turno" >
                                        @foreach($turnos as $turno)
                                            <option value="{{$turno}}">{{$turno}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <br>

                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <label for="dia" >Dia</label>
                                        <select id="dia" class="form-control" name="dia" >
                                            @foreach($dias as $dia)
                                                <option value="{{$loop->index}}">{{$dia}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="button" onclick="agregar()" class="btn btn-block btn-outline-info">
                                        <i class="fa fa-plus fa-1x"></i> Agregar
                                    </button>

                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered color-table info-table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>DIA</th>
                                            <th>ENTRADA</th>
                                            <th>SALIDA</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tabla"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <button id="guardar" type="submit" class="btn btn-info ">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var cont = 0;
            $(document).ready(
                function () {
                    evaluar();
                }
            );


            var agregados = [];

            function agregar() {
                var dia_id = $('#dia option:selected').val();
                var dia = $('#dia option:selected').text();


                if (!agregados.includes(dia_id) && dia != "") {
                    agregados.push(dia_id);
                    var fila = '' +
                        '<tr id="fila-'+cont+'">' +
                        '<td class="text-right">' +
                            '<button type="button" class="btn btn-outline-primary" onclick="eliminar('+cont+','+dia_id+')">' +
                                '<i class="fa fa-times"></i>' +
                            '</button>' +
                        '</td>' +
                        '<td><input required readonly class="form-control" type="text" name="nombresT[]" value="'+dia+'"></td>' +
                        '<td><input required class="form-control" type="time" name="entradasT[]" value="00:00"></td>' +
                        '<td><input required class="form-control" type="time" name="salidasT[]" value="00:00"></td>' +
                        '</tr>';
                    cont++;
                    limpiar();
                    $('#tabla').append(fila);
                }
                evaluar();
            }

            function limpiar(){
                $('#entrada').val("00:00");
                $('#salida').val("00:00");
            }

            function eliminar(index, id){
                var i = agregados.indexOf(String(id));
                if (i > -1) {
                    agregados.splice(i, 1);
                }
                cont--;
                $("#fila-" + index).remove();
                evaluar();
            }

            function evaluar(){
                if (cont > 0) {
                    $("#guardar").show();
                }else{
                    $("#guardar").hide();
                }
            }

        </script>
    @endpush



@endsection
