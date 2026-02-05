<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/change-avatar', [ProfileController::class, 'changeAvatar'])->name('profile.change-avatar');
});
Route::controller(ProductController::class)
->prefix('products')
->name('products.')
->group(function () {
    Route::get('/all', 'getAllProducts')->name('all');
    Route::get('/create', 'createProduct')->name('create');
    Route::post('/save', 'saveProduct')->name('save');
    Route::get('/flush', 'flushCache')->name('flush');
});
require __DIR__.'/auth.php';
