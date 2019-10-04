@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Editar localidad: {{$localidad->id}}
                    </h3>

                    <form method="POST" action="{{url('admin/localidades/'.$localidad->id)}}" autocomplete="off">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input required
                                           type="text"
                                           class="form-control"
                                           value="{{$localidad->nombre}}"
                                           name="nombre">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Provincia</label>
                                    <select class="form-control" name="provincia_id">
                                        @foreach($provincias as $provincia)
                                            @if($provincia->id == $localidad->provincia_id)
                                                <option selected value="{{$provincia->id}}">
                                                    {{$provincia->nombre}} - {{$provincia->departamento->nombre}}
                                                </option>
                                            @else
                                                <option value="{{$provincia->id}}">
                                                    {{$provincia->nombre}} - {{$provincia->departamento->nombre}}
                                                </option>
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
