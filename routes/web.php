<?php

use App\Http\Controllers\Admin\AliadoController;
use App\Http\Controllers\Admin\ConciliacionController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');

Route::view('/acceso', 'auth.acceso')->name('acceso');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/aliados', [AliadoController::class, 'index'])->name('aliados.index');
    Route::post('/aliados', [AliadoController::class, 'store'])->name('aliados.store');

    Route::get('/conciliaciones', [ConciliacionController::class, 'index'])->name('conciliaciones.index');
    Route::post('/conciliaciones', [ConciliacionController::class, 'store'])->name('conciliaciones.store');
});