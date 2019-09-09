@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Editar Rol: {{$rol->id}}
                    </h3>

                    <form method="POST" action="{{url('roles/'.$rol->id)}}" autocomplete="off">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="nombre" >Nombre</label>
                            <input type="text" class="form-control"  value="{{$rol->nombre}}" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
