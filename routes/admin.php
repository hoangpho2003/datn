<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderControllerr;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Routing\RouteUri;

Route::get('/index', [AdminController::class, 'index'])->name('index');

//BRANDS ROUTES
Route::get('/brands', [BrandsController::class, 'index'])->name('brands');
Route::get('/brand/create', [BrandsController::class, 'create'])->name('brands.create');
Route::post('/brand/store', [BrandsController::class, 'store'])->name('brands.store');
Route::get('/brand/edit/{id}', [BrandsController::class, 'edit'])->name('brands.edit');
Route::put('/brand/update', [BrandsController::class, 'update'])->name('brands.update');
Route::delete('/brand/delete/{id}', [BrandsController::class, 'delete'])->name('brands.delete');

//CATEGORIES ROUTES
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categorie/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categorie/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categorie/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categorie/update', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categorie/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

//PRODUCTS ROUTES
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/product/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');

//COUPONS ROUTES
Route::get('/coupons', [CouponController::class, 'index'])->name('coupons');
Route::get('/coupon/create', [CouponController::class, 'create'])->name('coupons.create');
Route::post('/coupon/store', [CouponController::class, 'store'])->name('coupons.store');
Route::get('/coupon/edit/{id}', [CouponController::class, 'edit'])->name('coupons.edit');
Route::put('/coupon/update', [CouponController::class, 'update'])->name('coupons.update');
Route::delete('/coupon/delete/{id}', [CouponController::class, 'delete'])->name('coupons.delete');

//ORDERS ROUTES
Route::get('/orders', [OrderControllerr::class, 'index'])->name('orders');
Route::get('/order/show/{id}', [OrderControllerr::class, 'show'])->name('orders.show');
Route::put('/order/update', [OrderControllerr::class, 'update'])->name('orders.update');