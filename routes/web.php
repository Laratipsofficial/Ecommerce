<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MarketingController::class, 'index'])->name('home');
Route::get('/menu', [MarketingController::class, 'menu'])->name('menu');
Route::get('/news', [MarketingController::class, 'news'])->name('news');
Route::get('/discounts', [MarketingController::class, 'discounts'])->name('discounts');
Route::get('/contact', [MarketingController::class, 'contact'])->name('contact');

// language switcher
Route::get('/lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang');

require __DIR__.'/auth.php';

// not found
Route::get('/not-found', function () {
    return Inertia::render('NotFound');
})->name('not-found');




// Content pages
Route::get('/{slug}', [MarketingController::class, 'content'])->name('content.show');


