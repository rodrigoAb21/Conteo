@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Nuevo Rol
                    </h3>

                    <form method="POST" action="{{url('roles')}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="nombre" >Nombre</label>
                            <input type="text" class="form-control"  value="{{old('nombre')}}" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
