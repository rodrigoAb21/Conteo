@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Editar Empleado: {{$empleado->id}}
                    </h3>

                    <form method="POST" action="{{url('empleados/'.$empleado->id)}}" autocomplete="off" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" required class="form-control"  value="{{$empleado->nombre}}" name="nombre">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="text" required class="form-control"  value="{{$empleado->telefono}}" name="telefono">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Direccion</label>
                                    <input type="text" required class="form-control"   value="{{$empleado->direccion}}" name="direccion">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Rol</label>
                                    <select class="form-control" name="rol_id">
                                        @foreach($roles as $rol)
                                            @if($rol -> id == $empleado -> rol_id)
                                                <option selected value="{{$rol->id}}">{{$rol->nombre}}</option>
                                            @else
                                                <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Ubicacion</label>
                                    <select class="form-control" name="ubicacion_id">
                                        @foreach($ubicaciones as $ubicacion)
                                            @if($ubicacion -> id == $empleado -> ubicacion_id)
                                                <option selected value="{{$ubicacion->id}}">{{$ubicacion->nombre}}</option>
                                            @else
                                                <option value="{{$ubicacion->id}}">{{$ubicacion->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" required class="form-control"   value="{{$empleado->email}}" name="email">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control"  name="password">
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
