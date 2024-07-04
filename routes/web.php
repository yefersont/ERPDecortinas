<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CotizacioneController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DeudoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cotizaciones',CotizacioneController::class);
Route::resource('ventas',VentaController::class);
Route::resource('clientes',ClienteController::class);
Route::patch('/clientes/{id}', [ClienteController::class, 'update']);
Route::resource('deudores',DeudoreController::class);



