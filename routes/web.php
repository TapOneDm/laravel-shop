<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::delete('cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');