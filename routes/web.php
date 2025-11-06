<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

///SHOP ROUTES
Route::get('/shop', action: [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', action: [ShopController::class, 'show'])->name('shop.show');

///CART ROUTES
Route::get('/cart', action: [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', action: [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/increase/{rowId}', action: [CartController::class, 'increase'])->name('cart.increase');
Route::put('/cart/decrease/{rowId}', action: [CartController::class, 'decrease'])->name('cart.decrease');
Route::delete('/cart/remove/{rowId}', action: [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', action: [CartController::class, 'clear'])->name('cart.clear');

///WISHLIST ROUTES
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');