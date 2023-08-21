<?php


use App\Http\Controllers\Tablets\CartController;
use App\Http\Controllers\Tablets\HistoryController;
use App\Http\Controllers\Tablets\MenuController;
use App\Http\Controllers\Tablets\TabletController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




Route::middleware('auth')->get('/', function () {
    return Inertia::render('Tablets/Home');
})->name('welcome');

// add reset route to resource
Route::resource('/', TabletController::class);
Route::get('/reset', [TabletController::class, 'reset'])->name('reset');

// group them with auth middleware
Route::middleware('auth', 'tablets')->group(function () {

    Route::resource('cart', CartController::class)->parameters([
        'cart' => 'id'
    ]);
    Route::resource('history', HistoryController::class);
    Route::resource('menus', MenuController::class)->parameters([
        'menus' => 'menu-item'
    ]);
});
