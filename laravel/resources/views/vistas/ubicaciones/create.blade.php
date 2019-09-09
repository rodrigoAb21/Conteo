@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Nueva Ubicacion
                    </h3>

                    <form method="POST" action="{{url('ubicaciones')}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" required class="form-control"  value="{{old('nombre')}}" name="nombre">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="text" required class="form-control"  value="{{old('telefono')}}" name="telefono">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Direccion</label>
                                    <input type="text" required class="form-control"  value="{{old('direccion')}}" name="direccion">
                                </div>
                            </div>
                            <input type="hidden" required id="latitud" name="latitud">
                            <input type="hidden" required id="longitud" name="longitud">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="map" style="width: 100%; height: 400px; background: #b4c1cd; margin-bottom: 1rem"></div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </form>
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
            var map = L.mapbox.map('map')
                .setView([-17.783346, -63.180589], 13)
                .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

            var marcador = L.marker([-17.783346, -63.180589]).addTo(map);

            $('#latitud').val(-17.783346);
            $('#longitud').val(-63.180589);

            map.on('click', function (e) {
                if ( marcador ) {
                    marcador.setLatLng(e.latlng);
                } else {
                    marcador = L.marker(e.latlng).addTo(map);
                }
                $('#latitud').val(e.latlng.lat);
                $('#longitud').val(e.latlng.lng);
            });
        </script>
    @endpush
@endsection
