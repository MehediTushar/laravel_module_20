<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('index');

Route::resource('products', ProductController::class);


// Route::get('/products/create', [ProductController::class, 'create'])->name('create');
// Route::post('/products', [ProductController::class, 'store'])->name('store');
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('show');
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('edit');
// Route::get('/products/{id}', [ProductController::class, 'update'])->name('update');
// Route::get('/products/{id}', [ProductController::class, 'delete'])->name('delete');


