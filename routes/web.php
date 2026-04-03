<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AliadoController;
use App\Http\Controllers\Admin\ConciliacionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::redirect('/', '/admin');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'store'])
        ->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'aliado.activo', 'role:administrador,usuario'])->group(function () {    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/conciliaciones', [ConciliacionController::class, 'index'])->name('conciliaciones.index');
    Route::post('/conciliaciones', [ConciliacionController::class, 'store'])->name('conciliaciones.store');
    Route::put('/conciliaciones/{conciliacion}', [ConciliacionController::class, 'update'])->name('conciliaciones.update');

    Route::middleware('role:administrador')->group(function () {
        Route::get('/aliados', [AliadoController::class, 'index'])->name('aliados.index');
        Route::post('/aliados', [AliadoController::class, 'store'])->name('aliados.store');
        Route::put('/aliados/{aliado}', [AliadoController::class, 'update'])->name('aliados.update');
    });
});