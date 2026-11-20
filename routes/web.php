<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\VadminisController;


Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', fn () => redirect()->route('produc.index'))
    ->middleware('auth','verified')->name('dashboard');

// Administrador
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'rol:Administrador')->group(function (){

    Route::get('/vadmin/detalle', [VadminisController::class, 'detalleAdmin'])
    ->name('vadmin.detalle')
    ->middleware('auth');

    Route::resource('produc',ProductosController::class);
    Route::resource('categor', CategoriaController::class); 
    Route::resource('movi', MovimientoController::class);
    Route::resource('vadmin', VadminisController::class);

    Route::post('/vadmin/anular', [VadminisController::class, 'anular'])
    ->name('vadmin.anular')
    ->middleware('auth');

    
});

// Usuario
Route::get('/dashboard', fn () => redirect()->route('ventas.index'))
    ->middleware('auth','verified')->name('dashboard');

Route::middleware('auth', 'rol:Usuario')->group(function (){

    Route::get('/ventas/detalle', [VentasController::class, 'detalle'])
    ->name('ventas.detalle')
    ->middleware('auth');

    Route::resource('ventas', VentasController::class);
    Route::post('/ventas/anular', [VentasController::class, 'anular'])
    ->name('ventas.anular')
    ->middleware('auth');

    

});

require __DIR__.'/auth.php';
