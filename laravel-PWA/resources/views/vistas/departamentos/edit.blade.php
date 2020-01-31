@extends('layouts.index')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Editar departamento: {{$departamento->id}}
                    </h3>

                    <form method="POST" action="{{url('admin/departamentos/'.$departamento->id)}}" autocomplete="off">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input required
                                           type="text"
                                           class="form-control"
                                           value="{{$departamento->nombre}}"
                                           name="nombre">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Pais</label>
                                    <select class="form-control selectpicker" data-style="btn btn-link" name="pais_id">
                                        @foreach($paises as $pais)
                                            @if($pais->id == $departamento->pais_id)
                                                <option selected value="{{$pais->id}}">{{$pais->nombre}}</option>
                                            @else
                                                <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-sm">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
