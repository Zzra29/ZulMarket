<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route API untuk Tabulator
Route::get('/products/api', [ProductController::class, 'apiData'])
    ->name('products.api');

// Route CRUD Products
Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('products.index');
});