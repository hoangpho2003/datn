<?php

use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\VnpayController;

Route::get('/index', [UserController::class, 'index'])->name('index');

//ORDERS ROUTES
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
Route::put('/order/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

//ADDRESS ROUTES
Route::get('/addresses', [AddressController::class, 'index'])->name('addresses');
Route::get('/address/create', [AddressController::class, 'create'])->name('address.create');
Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
Route::get('/address/{address}/edit', [AddressController::class, 'edit'])->name('address.edit');
Route::put('/address/{address}/update', [AddressController::class, 'update'])->name('address.update');
Route::delete('/address/{address}/delete', [AddressController::class, 'destroy'])->name('address.delete');

//ACCOUNT DETAILS ROUTES
Route::get('/account/details', [UserController::class, 'accountDetails'])->name('account');
Route::put('/account/update', [UserController::class, 'updateAccount'])->name('account.update');

//REVIEWS ROUTES
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
Route::put('/review/{review}/update', [ReviewController::class, 'update'])->name('review.update');

///Checkout ROUTES
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/placeAnOrder', [CheckoutController::class, 'placeAnOrder'])->name('checkout.placeAnOrder');
Route::get('/checkout/orderConfirmation', [CheckoutController::class, 'orderConfirmation'])->name('checkout.orderConfirmation');

///VNPAY ROUTES
Route::get('/vnpay/payment', [VnpayController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/vnpay/return', [VnpayController::class, 'return'])->name('vnpay.return');
Route::get('/vnpay/ipn', [VnpayController::class, 'ipn'])->name('vnpay.ipn');
