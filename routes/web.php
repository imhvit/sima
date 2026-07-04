<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('app.dashboard');
    }

    return inertia('Welcome');
})->name('welcome');

// Ruta: /app/*
Route::middleware('auth')->prefix('/app')->group(function () {
    Route::get('/', function () {
        return redirect()->route('app.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('app.dashboard');
});


require __DIR__ . '/auth.php';
