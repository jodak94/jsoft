<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

Route::get('categories', [ProductController::class, 'category_index'])->name('categories');
Route::get('categories/create', [ProductController::class, 'category_create'])->name('categories.create');
Route::post('categories', [ProductController::class, 'category_store'])->name('category_store');
Route::get('categories/edit/{category}', [ProductController::class, 'category_edit'])->name('categories.edit');
Route::put('categories/{category}', [ProductController::class, 'category_update'])->name('categories.update');

Route::get('subcategories', [ProductController::class, 'subcategory_index'])->name('subcategories');
Route::get('subcategories/create', [ProductController::class, 'subcategory_create'])->name('subcategories.create');

Route::get('warehouses', [WarehouseController::class, 'index'])->name('warehouses');
