@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">Resultados: "{{$eleccion->nombre}}"</h3>
                    <div class="row">
                        <!-- column -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Line Chart</h4>
                                    <div>
                                        <canvas id="chart1" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- column -->
                        <!-- column -->
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
                        <!-- column -->
                        <!-- column -->
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
                        <!-- column -->
                        <!-- column -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Doughnut Chart</h4>
                                    <div>
                                        <canvas id="chart4" height="150"> </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- column -->
                        <!-- column -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Polar Area Chart</h4>
                                    <div>
                                        <canvas id="chart5" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- column -->
                        <!-- column -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Radar Chart</h4>
                                    <div>
                                        <canvas id="chart6" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- column -->
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
        <script src="{{asset('plantilla/assets/plugins/Chart.js/chartjs.init.js')}}"></script>
    @endpush()
@endsection
