@extends('layouts.index')

@section('contenido')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-2">
                        Generar Reporte
                    </h3>

                    <form method="POST" action="{{url('reportes')}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="form-group row container">
                            <label class="col-form-label">Mes</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="mes">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>

                            <label class="col-form-label">Año</label>
                            <div class="col-sm-3">
                                <input type="number" min="2019" required class="form-control"  value="2019" name="anio">
                            </div>

                            <button type="submit" class="btn btn-info">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
