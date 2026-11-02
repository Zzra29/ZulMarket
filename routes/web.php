<?php
use App\Http\Controllers\productController;
use Illuminate\Support\Facades\Route;


    Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('products.index');
});
