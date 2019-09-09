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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('elecciones', 'Web\EleccionController');
    Route::resource('participantes', 'Web\ParticipanteController');
    Route::resource('paises', 'Web\PaisController');
    Route::resource('departamentos', 'Web\DepartamentoController');
    Route::resource('provincias', 'Web\ProvinciaController');
    Route::resource('localidades', 'Web\LocalidadController');
    Route::resource('recintos', 'Web\RecintoController');
    Route::resource('mesas', 'Web\MesaController');
});
