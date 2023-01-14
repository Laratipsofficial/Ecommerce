<?php

use App\Http\Controllers\Front\CategoryProductsController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductDetailController;
use App\Http\Controllers\Front\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('products', ProductsController::class)->name('products');
Route::get('category/{category:slug}', CategoryProductsController::class)->name('category-products');
Route::get('{product:slug}', ProductDetailController::class)->name('products.show');
