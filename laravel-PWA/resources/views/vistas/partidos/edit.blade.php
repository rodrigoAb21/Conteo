@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Editar Participante: {{$partido->id}}
                    </h3>

                    <form method="POST" action="{{url('admin/partidos/'.$partido->id)}}" autocomplete="off">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input required
                                           type="text"
                                           class="form-control"
                                           value="{{$partido->nombre}}"
                                           name="nombre">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Sigla</label>
                                    <input required
                                           type="text"
                                           class="form-control"
                                           value="{{$partido->sigla}}"
                                           name="sigla">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input required
                                           type="color"
                                           class="form-control"
                                           value="{{$partido->color}}"
                                           name="color">
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
