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
    return redirect()->intended('home');
})->name('home');


Route::get('/recibo', function () {
    return view('table');
});

Auth::routes();

Route::get('/pdf', 'PagosController@pdf');

Route::get('/registro/{token}', ['uses' =>'Auth\RegisterController@registro']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home',['uses' =>'HomeController@index']);

    Route::resource('vivienda', 'ViviendaController');
    Route::resource('residentes', 'ResidentesController');
    Route::post('/residentes/token', ['uses' =>'ResidentesController@generarToken'])->name('residentes.generarToken');
    Route::post('/staff/token', ['uses' =>'StaffController@generarToken'])->name('staff.generarToken');
    Route::resource('cuotas', 'CuotasController');
    Route::resource('recibosHeader', 'RecibosHeaderController');
    Route::resource('recibos', 'RecibosController');
    Route::get('/recibos/payAndBackToRecibos/{rec_id}', ['uses' =>'RecibosController@payAndBackToRecibos'])->name('recibos.payAndBackToRecibos');
    Route::get('/recibosHeader/export/{hdr_id}', ['uses' =>'RecibosHeaderController@exportar'])->name('recibosHeader.exportar');
    Route::get('/recibos/getPdf/{rec_id}', ['uses' =>'RecibosController@getPdf'])->name('recibos.getPdf');
    Route::post('/estadoCta/export', ['uses' =>'CuentasController@exportar'])->name('estadoCta.exportar');
    Route::resource('cuentas', 'CuentasController');
    Route::get('/movimientos/create/{cuenta_id}', ['uses' =>'CuentamovimientoController@create'])->name('movimientos.create');
    Route::resource('movimientos', 'CuentamovimientoController',['except' => ['create']]);
    Route::resource('pagos', 'PagosController');
    Route::resource('documento', 'DocumentoController');
    Route::resource('config', 'ConfigController');
    Route::resource('staff', 'StaffController');
    //Comunicacion
    Route::get('/comunicacion/', ['uses' =>'ComunicacionController@index'])->name('comunicacion.index');
    Route::get('/reportes/mora/', ['uses' =>'ComunicacionController@mora'])->name('comunicacion.mora');
    Route::post('/comunicacion/send', ['uses' =>'ComunicacionController@send'])->name('comunicacion.send');
    Route::post('/vivienda/generarRecibo', ['uses' =>'ViviendaController@generarRecibo'])->name('vivienda.generarRecibo');
    Route::post('/recibos/cancelar', ['uses' =>'RecibosController@cancelar'])->name('recibos.cancelar');
});
