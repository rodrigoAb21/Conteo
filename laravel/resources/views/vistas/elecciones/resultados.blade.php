@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Resultados: "{{$eleccion->nombre}}"</h3>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Pie Chart</h4>
                                    <div>
                                        <canvas id="chart3" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Bar Chart</h4>
                                    <div>
                                        <canvas id="chart2" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a href="{{url('elecciones')}}">
                        <button class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Atras
                        </button>
                    </a>
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
                        value: parseInt('{{$resultado -> total}}'),
                        color:'{{$resultado -> color}}',
                        highlight: '{{$resultado -> color}}',
                        label: '{{$resultado -> nombre}}',
                    });
                    labels.push('{{$resultado -> nombre}}');
                    data.push(parseInt('{{$resultado -> total}}'));
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
