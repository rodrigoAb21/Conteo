@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Editar Empleado: {{$eleccion->id}}
                    </h3>

                    <form method="POST" action="{{url('admin/elecciones/'.$eleccion->id)}}" autocomplete="off">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input required
                                           type="text"
                                           class="form-control"
                                           value="{{$eleccion->nombre}}"
                                           name="nombre">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input required
                                           type="date"
                                           class="form-control"
                                           value="{{$eleccion->fecha}}"
                                           name="fecha">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nro Mesas</label>
                                    <input required
                                           type="number"
                                           class="form-control"
                                           value="{{$eleccion->mesas}}"
                                           min="1"
                                           max="200"
                                           name="mesas">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" name="estado">
                                        @foreach($estados as $estado)
                                            @if($estado == $eleccion->estado)
                                                <option selected value="{{$estado}}">{{$estado}}</option>
                                            @else
                                                <option value="{{$estado}}">{{$estado}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select class="form-control" name="tipo">
                                        @foreach($tipos as $tipo)
                                            @if($tipo == $eleccion->tipo)
                                                <option selected value="{{$tipo}}">{{$tipo}}</option>
                                            @else
                                                <option value="{{$tipo}}">{{$tipo}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
