<?php
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
});

Route::get('/', function () {
    return view('products.index');
});
