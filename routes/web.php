<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MakeOrderController;
use App\Http\Controllers\OrderController;

Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::get('/makeOrder', [MakeOrderController::class, 'create'])->name('makeOrder.create');
Route::post('/makeOrder', [MakeOrderController::class, 'store'])->name('makeOrder.store');
Route::get('/order', [OrderController::class, 'show'])->name('order');
