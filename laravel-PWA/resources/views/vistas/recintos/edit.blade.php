@extends('layouts.index')

@section('contenido')
    <div class="row">
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
                                    <label>Municipio</label>
                                    <select class="form-control selectpicker" data-style="btn btn-link"  name="municipio_id">
                                        @foreach($municipios as $municipio)
                                            @if($municipio->id == $recinto->municipio_id)
                                                <option selected value="{{$municipio->id}}">{{$municipio->nombre}} - {{$municipio->provincia->nombre}} - {{$municipio->provincia->departamento->nombre}}</option>
                                            @else
                                                <option value="{{$municipio->id}}">{{$municipio->nombre}} - {{$municipio->provincia->nombre}} - {{$municipio->provincia->departamento->nombre}}</option>
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

                        <button type="submit" class="btn btn-info  btn-sm">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
