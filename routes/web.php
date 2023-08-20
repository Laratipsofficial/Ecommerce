<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MarketingController::class, 'index'])->name('home');
Route::get('/menu', [MarketingController::class, 'menu'])->name('menu');
Route::get('/news', [MarketingController::class, 'news'])->name('news');
Route::get('/discounts', [MarketingController::class, 'discounts'])->name('discounts');
Route::get('/contact', [MarketingController::class, 'contact'])->name('contact');


// Content pages
Route::get('/{slug}', [MarketingController::class, 'content'])->name('content.show');


