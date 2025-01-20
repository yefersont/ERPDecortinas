<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CotizacioneController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DeudoreController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CitasController;



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

Route::resource('cotizaciones', CotizacioneController::class);
Route::put('cotizaciones/{id}', [CotizacioneController::class, 'update'])->name('ActualizarCotizacion');

Route::resource('ventas', VentaController::class);

Route::resource('clientes', ClienteController::class);
Route::put('clientes/{id}', [ClienteController::class, 'update'])->name('ActualizarCliente');

Route::resource('deudores', DeudoreController::class);


Route::resource('ventas', VentaController::class);
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');

Route::resource('deudores', DeudoreController::class);
Route::post('/deudores', [DeudoreController::class, 'store'])->name('deudores.store');



Route::get('/divisas', [CurrencyController::class, 'index']);
Route::post('/divisas/convertir', [CurrencyController::class, 'convertir'])->name('divisas.convertir');

Route::resource('citas', CitasController::class);