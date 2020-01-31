@extends('layouts.index')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Nueva provincia
                    </h3>

                    <form method="POST" action="{{url('admin/provincias')}}" autocomplete="off">
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
                                    <label>Departamento</label>
                                    <select class="form-control selectpicker" data-style="btn btn-link"  name="departamento_id">
                                        @foreach($departamentos as $departamento)
                                            <option value="{{$departamento->id}}">
                                                {{$departamento->nombre}}
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
