<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitWebController;

Route::resource('unit',App\Http\Controllers\UnitWebController::class);