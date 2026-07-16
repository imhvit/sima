<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
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
        Route::get('/products/{product}/show', [ProductController::class, 'show'])->name('app.catalog.products.show');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('app.catalog.products.edit');
        Route::post('/products', [ProductController::class, 'store'])->name('app.catalog.products.store');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('app.catalog.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('app.catalog.products.delete');
        // categories
        Route::get('/categories', [CatalogController::class, 'categories'])->name('app.catalog.categories');
        Route::get('/categories/{category}/show', [CategoryController::class, 'show'])->name('app.catalog.categories.show');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('app.catalog.categories.edit');
        Route::post('/categories', [CategoryController::class, 'store'])->name('app.catalog.categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('app.catalog.categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'delete'])->name('app.catalog.categories.delete');
    });
});


require __DIR__ . '/auth.php';
