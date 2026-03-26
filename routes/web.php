<?php

use App\Http\Controllers\Admin\AliadoController;
use App\Http\Controllers\Admin\ConciliacionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;

Route::redirect('/', '/admin');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::view('/acceso', 'auth.acceso')->name('acceso');
Route::post('/acceso/enviar', [AliadoController::class, 'enviarEnlace'])->name('acceso.enviar');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/aliados', [AliadoController::class, 'index'])->name('aliados.index');
    Route::post('/aliados', [AliadoController::class, 'store'])->name('aliados.store');
    Route::put('/aliados/{aliado}', [AliadoController::class, 'update'])->name('aliados.update');

    Route::get('/conciliaciones', [ConciliacionController::class, 'index'])->name('conciliaciones.index');
    Route::post('/conciliaciones', [ConciliacionController::class, 'store'])->name('conciliaciones.store');
    Route::put('/conciliaciones/{conciliacion}', [ConciliacionController::class, 'update'])->name('conciliaciones.update');
});