<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
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
//Products
Route::get('products', [ProductController::class, 'index'])->name('products');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('products/warehouses-data/{product}', [ProductController::class, 'warehousesData'])->name('products.warehouses_data');

//Categories
Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('categories/subcategories/{category}', [CategoryController::class, 'subcategories'])->name('categories.subcategories');

//Subcategories
Route::get('subcategories', [SubcategoryController::class, 'index'])->name('subcategories');
Route::get('subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
Route::post('subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
Route::get('subcategories/edit/{subcategory}', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
Route::put('subcategories/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
Route::delete('subcategories/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');

//Warehouses
Route::get('warehouses', [WarehouseController::class, 'index'])->name('warehouses');
Route::get('warehouses/create', [WarehouseController::class, 'create'])->name('warehouses.create');
Route::post('warehouses', [WarehouseController::class, 'store'])->name('warehouses.store');
Route::get('warehouses/edit/{warehouse}', [WarehouseController::class, 'edit'])->name('warehouses.edit');
Route::put('warehouses/{warehouse}', [WarehouseController::class, 'update'])->name('warehouses.update');
Route::delete('warehouses/{warehouse}', [WarehouseController::class, 'destroy'])->name('warehouses.destroy');

//Clients
Route::get('clients', [ClientController::class, 'index'])->name('clients');
Route::get('clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('clients/edit/{client}', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('clients/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

//Providers
Route::get('providers', [ProviderController::class, 'index'])->name('providers');
Route::get('providers/create', [ProviderController::class, 'create'])->name('providers.create');
Route::post('providers', [ProviderController::class, 'store'])->name('providers.store');
Route::get('providers/edit/{provider}', [ProviderController::class, 'edit'])->name('providers.edit');
Route::put('providers/{provider}', [ProviderController::class, 'update'])->name('providers.update');
Route::delete('providers/{provider}', [ProviderController::class, 'destroy'])->name('providers.destroy');
