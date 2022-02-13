<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\SubcategoryController;
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('products', [ProductController::class, 'index'])->name('products');

// Categories
Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

//Subcategories
Route::get('subcategories', [SubcategoryController::class, 'index'])->name('subcategories');
Route::get('subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
Route::post('subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
Route::get('subcategories/edit/{category}', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
Route::put('subcategories/{category}', [SubcategoryController::class, 'update'])->name('subcategories.update');
Route::delete('categories/{category}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');

Route::get('warehouses', [WarehouseController::class, 'index'])->name('warehouses');
