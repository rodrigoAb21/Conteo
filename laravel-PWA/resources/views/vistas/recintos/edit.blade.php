@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Editar recinto: {{$recinto->id}}
                    </h3>

                    <form method="POST" action="{{url('admin/recintos/'.$recinto->id)}}" autocomplete="off">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input required
                                           type="text"
                                           class="form-control"
                                           value="{{$recinto->nombre}}"
                                           name="nombre">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Localidad</label>
                                    <select class="form-control" name="localidad_id">
                                        @foreach($localidades as $localidad)
                                            @if($localidad->id == $recinto->localidad_id)
                                                <option selected value="{{$localidad->id}}">{{$localidad->nombre}} - {{$localidad->provincia->nombre}} - {{$localidad->provincia->departamento->nombre}}</option>
                                            @else
                                                <option value="{{$localidad->id}}">{{$localidad->nombre}} - {{$localidad->provincia->nombre}} - {{$localidad->provincia->departamento->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Direccion</label>
                                    <textarea required
                                              class="form-control"
                                              name="direccion"
                                              rows="3">{{$recinto->direccion}}</textarea>
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
