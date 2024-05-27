<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\MauSacController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonHangController;

Route::get('/',[HomeController::class, 'index'])->name("home");
Route::get('login',[AuthController::class, 'login'])->name("login");

Route::get('sanpham',[SanPhamController::class, 'index'])->name("sanpham.index");
Route::get('capnhatsanpham',[SanPhamController::class, 'edit'])->name("sanpham.edit");
Route::get('themsanpham',[SanPhamController::class, 'add'])->name("sanpham.add");





Route::get('danhmuc',[DanhMucController::class, 'index'])->name("danhmuc.index");
Route::get('thuonghieu',[ThuongHieuController::class, 'index'])->name("thuonghieu.index");
Route::get('size',[SizeController::class, 'index'])->name("size.index");
Route::get('mausac',[MauSacController::class, 'index'])->name("mausac.index");
Route::get('khachhang',[KhachHangController::class, 'index'])->name("khachhang.index");
Route::get('admin',[AdminController::class, 'index'])->name("admin.index");
Route::get('profile',[AdminController::class, 'profile'])->name("admin.profile");
Route::get('donhang',[DonHangController::class, 'index'])->name("donhang.index");