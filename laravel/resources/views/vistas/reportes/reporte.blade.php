@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Reporte: {{$mes}} - {{$anio}}
                    </h3>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered color-table info-table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Hrs. Trabajo</th>
                                <th>Hrs. Trabajadas</th>
                                <th>Hrs. Retraso</th>
                                <th>Hrs. Extras</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tuplas as $tupla)
                                <tr>
                                    <td>{{$tupla -> nombre}}</td>
                                    <td>{{$tupla -> hrsTrabajo}}</td>
                                    <td>{{$tupla -> hrsTrabajadas}}</td>
                                    <td>{{$tupla -> hrsRetraso}}</td>
                                    <td>{{$tupla -> hrsExtras}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{url('reportes')}}">
                        <button class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Atras
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
