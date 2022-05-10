<?php

use App\Http\Controllers\Admin\AttachPermissionToRoleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetachPermissionFromRoleController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::post('roles/attach-permission', AttachPermissionToRoleController::class)
        ->name('roles.attach-permission');
    Route::post('roles/detach-permission', DetachPermissionFromRoleController::class)
        ->name('roles.detach-permission');

    Route::get('roles', [RolesController::class, 'index'])
        ->name('roles.index')
        ->middleware(['can:view roles list']);
    Route::get('roles/create', [RolesController::class, 'create'])
        ->name('roles.create')
        ->middleware(['can:create role']);
    Route::post('roles', [RolesController::class, 'store'])
        ->name('roles.store')
        ->middleware(['can:create role']);
    Route::get('roles/{role}', [RolesController::class, 'edit'])
        ->name('roles.edit')
        ->middleware(['can:edit role']);
    Route::put('roles/{role}', [RolesController::class, 'update'])
        ->name('roles.update')
        ->middleware(['can:edit role']);
    Route::delete('roles/{role}', [RolesController::class, 'destroy'])
        ->name('roles.destroy')
        ->middleware(['can:delete role']);

    Route::get('permissions', [PermissionsController::class, 'index'])
        ->name('permissions.index')
        ->middleware(['can:view permissions list']);
    Route::get('permissions/create', [PermissionsController::class, 'create'])
        ->name('permissions.create')
        ->middleware(['can:create permission']);
    Route::post('permissions', [PermissionsController::class, 'store'])
        ->name('permissions.store')
        ->middleware(['can:create permission']);
    Route::get('permissions/{permission}', [PermissionsController::class, 'edit'])
        ->name('permissions.edit')
        ->middleware(['can:edit permission']);
    Route::put('permissions/{permission}', [PermissionsController::class, 'update'])
        ->name('permissions.update')
        ->middleware(['can:edit permission']);
    Route::delete('permissions/{permission}', [PermissionsController::class, 'destroy'])
        ->name('permissions.destroy')
        ->middleware(['can:delete permission']);
});

require __DIR__ . '/auth.php';
