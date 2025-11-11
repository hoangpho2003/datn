<?php

use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserController;

Route::get('/index', [UserController::class, 'index'])->name('index');

//ORDERS ROUTES
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
Route::put('/order/cancel', [OrderController::class, 'cancel'])->name('order.cancel');