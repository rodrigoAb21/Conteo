@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Editar Participante: {{$participante->id}}
                    </h3>

                    <form method="POST" action="{{url('participantes/'.$participante->id)}}" autocomplete="off" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input required
                                           type="text"
                                           class="form-control"
                                           value="{{$participante->nombre}}"
                                           name="nombre">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" name="color">
                                        @foreach($colores as $color)
                                            @if($color->valor == $participante->color)
                                                <option selected value="{{$color->valor}}">
                                                    {{$color->nombre}}
                                                </option>
                                            @else
                                                <option value="{{$color->valor}}">
                                                    {{$color->nombre}}
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
