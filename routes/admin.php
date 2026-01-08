<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderControllerr;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SlideControllerr;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SearchController;
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
Route::get('/brands-by-category/{category}', [ProductController::class, 'getByCategory']);

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

//SLIDES ROUTES
Route::get('/slides', [SlideControllerr::class, 'index'])->name('slides');
Route::get('/slides/create', [SlideControllerr::class, 'create'])->name('slides.create');
Route::post('/slides/store', [SlideControllerr::class, 'store'])->name('slides.store');
Route::get('/slides/edit/{id}', [SlideControllerr::class, 'edit'])->name('slides.edit');
Route::put('/slides/update', [SlideControllerr::class, 'update'])->name('slides.update');
Route::delete('/slides/delete/{id}', [SlideControllerr::class, 'delete'])->name('slides.delete');

///CONTACTS ROUTES
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::delete('/contacts/delete/{id}', [ContactController::class, 'delete'])->name('contacts.delete');

///Search routes
Route::get('/search', [SearchController::class, 'adminProductSearch'])->name('search');

/// USERS ROUTES
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');