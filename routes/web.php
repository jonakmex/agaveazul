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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('vivienda', 'ViviendaController');
    Route::get('/vivienda/crearResidente/{vivienda_id}', ['uses' =>'ViviendaController@crearResidente'])->name('crearResidente');
    Route::resource('residentes', 'ResidentesController');
    Route::resource('cuotas', 'CuotasController');
    Route::resource('recibos', 'RecibosController');
    Route::resource('cuentas', 'CuentasController');
    Route::resource('pagos', 'PagosController');
    Route::resource('recibosHeader', 'RecibosHeaderController');
    Route::get('/recibos/payAndBackToVivienda/{rec_id}', ['uses' =>'RecibosController@payAndBackToVivienda'])->name('recibos.payAndBackToVivienda');
    Route::get('/recibos/payAndBackToRecibos/{rec_id}', ['uses' =>'RecibosController@payAndBackToRecibos'])->name('recibos.payAndBackToRecibos');
    Route::resource('movimientos', 'CuentamovimientoController',['except' => ['create']]);
    Route::get('/movimientos/create/{cuenta_id}', ['uses' =>'CuentamovimientoController@create'])->name('movimientos.create');
});
