<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('home.aboutUs');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('home.privacyPolicy');
Route::get('/temrm-conditions', [HomeController::class, 'termConditions'])->name('home.termConditions');

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
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.couponApply');
Route::delete('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.couponRemove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/placeAnOrder', [CartController::class, 'placeAnOrder'])->name('cart.placeAnOrder');
Route::get('/cart/orderConfirmation', [CartController::class, 'orderConfirmation'])->name('cart.orderConfirmation');

///WISHLIST ROUTES
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{rowId}', action: [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::delete('/wishlist/clear', action: [WishlistController::class, 'clear'])->name('wishlist.clear');
Route::post('/wishlist/moveToCart/{rowId}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');

///CONTACT ROUTES
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

///Search routes
Route::get('/search', [SearchController::class, 'productSearch'])->name('home.search');