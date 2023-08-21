<?php


use App\Http\Controllers\MarketingController;
use App\Http\Controllers\TakeAway\CartController;
use App\Http\Controllers\TakeAway\HistoryController;
use App\Http\Controllers\TakeAway\MenuController;
use App\Http\Controllers\TakeAway\OrderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// group them with auth middleware

    Route::resource('cart', CartController::class)->parameters([
        'cart' => 'id'
    ]);
    Route::resource('history', HistoryController::class);
    Route::resource('menus', MenuController::class)->parameters([
        'menus' => 'menu-item'
    ]);

    // order confirmation
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');

