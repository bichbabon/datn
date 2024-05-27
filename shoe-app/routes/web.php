<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GiohangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');


Route::get('product',[ProductController::class, 'index'])->name('product.index');
Route::get('product/{id}',[ProductController::class, 'detail'])->name('product.detail');

Route::get('giohang',[GioHangController::class, 'index'])->name('cart.index');
Route::get('donhang',[GioHangController::class, 'donhang'])->name('cart.order');


Route::get('login',[AuthController::class, 'login'])->name('login');
Route::get('register',[AuthController::class, 'register'])->name('register');
Route::get('profile',[AuthController::class, 'profile'])->name('profile');
