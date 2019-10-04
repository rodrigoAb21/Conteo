<?php

use Illuminate\Http\Request;

Route::get('elecciones', 'Api\ApiController@getEleccionesActivas');
Route::post('resultados', 'Api\ApiController@guardarResultados');
