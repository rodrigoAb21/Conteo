@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">"{{$eleccion->nombre}}" - {{$departamento->nombre}} - {{$provincia->nombre}} - {{$localidad->nombre}}</h3>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Grafico circular</h4>
                                    <div>
                                        <canvas id="chart3" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Grafico de barras</h4>
                                    <div>
                                        <canvas id="chart2" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered color-table primary-table">
                            <thead>
                            <tr>
                                <th class="text-center">POSICION</th>
                                <th class="text-center">SIGLA</th>
                                <th class="text-center">COLOR</th>
                                <th class="text-center">TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($resultados as $resultado)
                            <tr>

                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$resultado->sigla}}</td>
                                <td style="background: {{$resultado->color}};"></td>
                                <td class="text-center">{{$resultado->total}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="pb-2">Recintos</h3>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered color-table primary-table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">NOMBRE</th>
                                        <th class="text-center">OPCIONES</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recintos as $recinto)
                                    <tr>
                                        <td class="text-center">{{$recinto->id}}</td>
                                        <td class="text-center">{{$recinto->nombre}}</td>
                                        <td class="text-center ">
                                            <a href="{{url("resultados/$eleccion->id/$departamento->id/$provincia->id/$localidad->id/$recinto->id")}}">
                                            <button class="btn btn-primary">
                                                Ver resultados
                                            </button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$recintos->links('pagination.default')}}
                            </div>
                        </div>
                    </div>
                    <br>
                    <a href="{{url("/resultados/$eleccion->id/$departamento->id/$provincia->id")}}">
                        <button class="btn btn-primary">
                            {{$provincia->nombre}}
                        </button>
                    </a>
                    <a href="{{url("/resultados/$eleccion->id/$departamento->id")}}">
                        <button class="btn btn-primary">
                             {{$departamento->nombre}}
                        </button>
                    </a>
                    <a href="{{url("/resultados/$eleccion->id")}}">
                        <button class="btn btn-primary">
                            General
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $( document ).ready(function() {
        var data3 = [];
        var labels = [];
        var data = [];

    @foreach($resultados as $resultado)
        data3.push({
            value: parseInt('{{$resultado->total}}'),
            color:'{{$resultado->color}}',
            highlight: '{{$resultado->color}}',
            label: '{{$resultado->sigla}}',
        });
        labels.push('{{$resultado->sigla}}');
        data.push(parseInt('{{$resultado->total}}'));
        @endforeach

        var ctx2 = document.getElementById("chart2").getContext("2d");
        var data2 = {
            labels: labels,
            datasets: [
                {
                    label: "Resultados",
                    fillColor: "#ffffff",
                    strokeColor: "#d1d1d1",
                    highlightFill: "#d1d1d1",
                    highlightStroke: "#d1d1d1",
                    data: data
                }
            ]
        };

        var chart2 = new Chart(ctx2).Bar(data2, {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.005)",
            scaleGridLineWidth : 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke : true,
            barStrokeWidth : 0,
            tooltipCornerRadius: 2,
            barDatasetSpacing : 3,
            responsive: true,
        });

        chart2.generateLegend();



        var ctx3 = document.getElementById("chart3").getContext("2d");

        var myPieChart = new Chart(ctx3).Pie(data3,{
            segmentShowStroke : true,
            segmentStrokeColor : "#dbdbdb",
            segmentStrokeWidth : 1,
            animationSteps : 100,
            tooltipCornerRadius: 0,
            animationEasing : "easeOutBounce",
            animateRotate : true,
            animateScale : false,
            responsive: true
        });

    });
</script>
@endpush()
@endsection