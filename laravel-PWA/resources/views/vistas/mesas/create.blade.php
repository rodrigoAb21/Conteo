@extends('layouts.index')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Nueva mesa
                    </h3>

                    <form method="POST" action="{{url('admin/mesas')}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input required
                                           type="text"
                                           class="form-control"
                                           value="{{old('nombre')}}"
                                           name="nombre">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nro Inscritos</label>
                                    <input required
                                           type="number"
                                           class="form-control"
                                           value="{{old('inscritos')}}"
                                           name="inscritos">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Recinto</label>
                                    <select class="form-control selectpicker" data-style="btn btn-link"  name="recinto_id">
                                        @foreach($recintos as $recinto)
                                            <option value="{{$recinto->id}}">
                                                {{$recinto->nombre}} - {{$recinto->municipio->nombre}} - {{$recinto->municipio->provincia->nombre}} - {{$recinto->municipio->provincia->departamento->nombre}}
                                            </option>
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
