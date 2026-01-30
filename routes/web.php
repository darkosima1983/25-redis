<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::controller(ProductController::class)
->prefix('products')
->name('products.')
->group(function () {
    Route::get('/all', 'getAllProducts')->name('all');
    Route::get('/create', 'createProduct')->name('create');
    Route::post('/save', 'saveProduct')->name('save');
    Route::get('/flush', 'flushCache')->name('flush');
});