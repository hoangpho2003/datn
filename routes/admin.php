<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Routing\RouteUri;

Route::get('/index', [AdminController::class, 'index'])->name('index');

//BRANDS ROUTES
Route::get('/brands', [BrandsController::class, 'index'])->name('brands');
Route::get('/brands/create', [BrandsController::class, 'create'])->name('brands.create');
Route::post('/brands/store', [BrandsController::class, 'store'])->name('brands.store');
Route::get('/brands/edit/{id}', [BrandsController::class, 'edit'])->name('brands.edit');
Route::put('/brands/update', [BrandsController::class, 'update'])->name('brands.update');
Route::delete('/brands/delete/{id}', [BrandsController::class, 'delete'])->name('brands.delete');

//CATEGORIES ROUTES
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/update', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

//PRODUCTS ROUTES
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');