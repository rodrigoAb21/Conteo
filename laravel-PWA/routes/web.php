<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
    'as' => '',
    'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

Route::get('admin', function () {
    return view('home');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('admin/elecciones', 'Web\EleccionController');

    Route::get('admin/elecciones/resultados/{eleccion_id}', 'Web\EleccionController@resultados_generales');
    Route::get('admin/elecciones/resultados/{eleccion_id}/{dpto_id}', 'Web\EleccionController@resultados_departamento');
    Route::get('admin/elecciones/resultados/{eleccion_id}/{dpto_id}/{prov_id}', 'Web\EleccionController@resultados_provincia');
    Route::get('admin/elecciones/resultados/{eleccion_id}/{dpto_id}/{prov_id}/{local_id}', 'Web\EleccionController@resultados_localidad');
    Route::get('admin/elecciones/resultados/{eleccion_id}/{dpto_id}/{prov_id}/{local_id}/{rec_id}', 'Web\EleccionController@resultados_recinto');
    Route::get('admin/elecciones/resultados/{eleccion_id}/{dpto_id}/{prov_id}/{local_id}/{rec_id}/{mesa_id}', 'Web\EleccionController@resultados_mesa');

    Route::get('admin/elecciones/asignaciones/{id_eleccion}/{id_p_e}/quitar', 'Web\EleccionController@quitar');
    Route::get('admin/elecciones/asignaciones/{id}', 'Web\EleccionController@verAsignacion');
    Route::post('admin/elecciones/asignaciones/{id}', 'Web\EleccionController@asignar');

    Route::resource('admin/participantes', 'Web\ParticipanteController');
    Route::resource('admin/paises', 'Web\PaisController');
    Route::resource('admin/departamentos', 'Web\DepartamentoController');
    Route::resource('admin/provincias', 'Web\ProvinciaController');
    Route::resource('admin/localidades', 'Web\LocalidadController');
    Route::resource('admin/recintos', 'Web\RecintoController');
    Route::resource('admin/mesas', 'Web\MesaController');
});

Route::get('/', 'Web\WebController@getEleccionesActivas');
Route::get('resultados/{eleccion_id}', 'Web\WebController@resultados_generales');
Route::get('resultados/{eleccion_id}/{dpto_id}', 'Web\WebController@resultados_departamento');
Route::get('resultados/{eleccion_id}/{dpto_id}/{prov_id}', 'Web\WebController@resultados_provincia');
Route::get('resultados/{eleccion_id}/{dpto_id}/{prov_id}/{local_id}', 'Web\WebController@resultados_localidad');
Route::get('resultados/{eleccion_id}/{dpto_id}/{prov_id}/{local_id}/{rec_id}', 'Web\WebController@resultados_recinto');
Route::get('resultados/{eleccion_id}/{dpto_id}/{prov_id}/{local_id}/{rec_id}/{mesa_id}', 'Web\WebController@resultados_mesa');

