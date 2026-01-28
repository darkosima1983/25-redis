<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProductController::class)
->prefix('products')
->name('products.')
->group(function () {
    Route::get('/all', 'getAllProducts')->name('all');
    Route::get('/create', 'createProduct')->name('create');
    Route::post('/save', 'saveProduct')->name('save');
}); 