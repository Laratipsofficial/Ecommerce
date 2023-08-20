<?php

use App\Http\Controllers\Admin\Catogories\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Identity\AttachPermissionToRoleController;
use App\Http\Controllers\Admin\Identity\DetachPermissionFromRoleController;
use App\Http\Controllers\Admin\Identity\PermissionsController;
use App\Http\Controllers\Admin\Identity\RolesController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Home');
});


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::post('roles/attach-permission', AttachPermissionToRoleController::class)->name('roles.attach-permission');
    Route::post('roles/detach-permission', DetachPermissionFromRoleController::class)->name('roles.detach-permission');
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('users', UsersController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);
});

require __DIR__.'/auth.php';
