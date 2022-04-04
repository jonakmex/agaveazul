<?php

use Illuminate\Support\Facades\Route;
use App\Http\Factory\UseCaseFactoryContainer;
use App\Domains\Shared\Boundary\RequestFactory;
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
    return view('welcome');
});

Route::resource('unit',App\Http\Controllers\UnitWebController::class);
Route::resource('asset',App\Http\Controllers\AssetWebController::class);
Route::resource('contact',App\Http\Controllers\ContactWebController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


