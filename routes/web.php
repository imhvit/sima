<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
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

    // Catalog

    Route::prefix('/catalog')->group(function () {
        Route::get('/', function () {
            return redirect()->route('app.catalog.products');
        });
        // products
        Route::get('/products', [CatalogController::class, 'products'])->name('app.catalog.products');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('app.catalog.products.show');
        // categories
        Route::get('/categories', [CatalogController::class, 'categories'])->name('app.catalog.categories');
    });
});


require __DIR__ . '/auth.php';
