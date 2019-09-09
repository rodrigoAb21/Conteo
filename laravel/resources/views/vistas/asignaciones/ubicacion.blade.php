@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="pb-2"> Ubicacion asignada de: {{$empleado->nombre}}</h2>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label><b>NOMBRE</b></label>
                                        <p>{{$ubicacion->nombre}}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label><b>TELEFONO</b></label>
                                        <p>{{$ubicacion->telefono}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label><b>DIRECCION</b></label>
                                        <p>{{$ubicacion->direccion}}</p>
                                    </div>
                                </div>

                                <input type="hidden" value="{{$ubicacion->latitud}}" id="latitud" name="latitud">
                                <input type="hidden" value="{{$ubicacion->longitud}}" id="longitud" name="longitud">

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div id="map" style="width: 100%; height: 400px; background: #b4c1cd; margin-bottom: 1rem"></div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" action="{{url('asignaciones/ubicacion/'.$empleado->id.'/asignar')}}" autocomplete="off" >
                                {{method_field('patch')}}
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="mr-2">Nueva Ubicacion</label>
                                            <select class="form-control mr-2" name="ubicacion_id">
                                                @foreach($ubicaciones as $ubicacion)
                                                    <option value="{{$ubicacion->id}}">{{$ubicacion->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-block" > <i class="fa fa-sync"></i> Asignar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <a href="{{url('asignaciones')}}">
                                <button class="btn btn-warning">
                                    <i class="fa fa-arrow-left"></i> Atras
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('arriba')
        <script src='https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.js'></script>
        <link href='https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.css' rel='stylesheet' />
    @endpush

    @push('scripts')
        <script>
            L.mapbox.accessToken = 'pk.eyJ1Ijoicm9kcmlnb2FiMjEiLCJhIjoiY2psenZmcDZpMDN5bTNrcGN4Z2s2NWtqNSJ9.bSdjQfv-28z1j4zx7ljvcg';
            var inicial = L.latLng($('#latitud').val(), $('#longitud').val());
            var map = L.mapbox.map('map')
                .setView(inicial, 15)
                .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

            var marcador = L.marker(inicial).addTo(map);
        </script>
    @endpush
@endsection
