@extends('layouts.index')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="pb-2">"{{$eleccion->nombre}}" - {{$departamento->nombre}} - {{$provincia->nombre}}</h3>
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
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>

                                    <th class="text-center"><b>SIGLA</b></th>
                                    <th class="text-center"><b>COLOR</b></th>
                                    <th class="text-center"><b>PORCENTAJE</b></th>
                                    <th class="text-center"><b>TOTAL</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($resultados as $resultado)
                                    <tr>

                                        <td class="text-center">{{$resultado->sigla}}</td>
                                        <td style="background: {{$resultado->color}};"></td>
                                        <td class="text-center">{{round(($resultado->total*100)/$total,2)}} %</td>
                                        <td class="text-center">{{$resultado->total}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="pb-2">Municipios</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <tr>

                                            <th class="text-center"><b>NOMBRE</b></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($municipios as $municipio)
                                            <tr>

                                                <td class="text-center">{{$municipio->nombre}}</td>
                                                <td class="text-center ">
                                                    <a href="{{url("admin/elecciones/resultados/$eleccion->id/$departamento->id/$provincia->id/$municipio->id")}}">
                                                        <button class="btn btn-info btn-sm">
                                                            Ver resultados
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{$municipios->links('pagination.default')}}
                                </div>
                            </div>
                        </div>
                        <br>
                        <a href="{{url("admin/elecciones/resultados/$eleccion->id/$departamento->id")}}">
                            <button class="btn btn-info btn-sm">
                                 {{$departamento->nombre}}
                            </button>
                        </a>
                        <a href="{{url("admin/elecciones/resultados/$eleccion->id")}}">
                            <button class="btn btn-info btn-sm">
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
