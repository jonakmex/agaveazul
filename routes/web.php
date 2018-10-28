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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home',function(){
      return view('home');
    });
    Route::resource('vivienda', 'ViviendaController');
    Route::resource('residentes', 'ResidentesController');
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
});
