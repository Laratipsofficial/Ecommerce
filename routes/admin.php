<?php

use App\Http\Controllers\Admin\Catogories\CategoriesController;
use App\Http\Controllers\Admin\CmsContent\CmsContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Discounts\DiscountController;
use App\Http\Controllers\Admin\Discounts\DiscountItemController;
use App\Http\Controllers\Admin\Identity\AttachPermissionToRoleController;
use App\Http\Controllers\Admin\Identity\DetachPermissionFromRoleController;
use App\Http\Controllers\Admin\Identity\PermissionsController;
use App\Http\Controllers\Admin\Identity\RolesController;
use App\Http\Controllers\Admin\Menus\MenuItemController;
use App\Http\Controllers\Admin\Menus\MenuSectionController;
use App\Http\Controllers\Admin\Menus\MenuSideItemController;
use App\Http\Controllers\Admin\Orders\OrdersController;
use App\Http\Controllers\Admin\Orders\OrdersItemsController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\Tables\TableController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\TakeAway\OrderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return redirect()->route('admin.dashboard');
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

    // cms content
    Route::resource('content', CmsContentController::class);

    // tables
    Route::resource('tables', TableController::class);




    //group them in 'menus' prefix
    Route::prefix('menus')->group(function (){
        Route::resource('menus-sections', MenuSectionController::class)->parameters([
            'menus-sections' => 'menuSection'
        ]);
        Route::resource('menus-items', MenuItemController::class)->parameters([
            'menus-items' => 'menuItem'
        ]);
        Route::resource('menus-side-items', MenuSideItemController::class)->parameters([
            'menus-side-items' => 'menuSideItem'
        ]);
    });

    // discounts

        Route::resource('discounts', DiscountController::class)->parameters([
            'discounts' => 'discount'
        ]);
        Route::resource('discounts.items', DiscountItemController::class)->parameters([
            'discounts' => 'discount',
            'items' => 'discountItem'
        ]);

        // orders resource
        Route::resource('orders', OrdersController::class)->parameters([
            'orders' => 'order'
        ]);

        // order items
        Route::resource('orders.items', OrdersItemsController::class)->parameters([
            'orders' => 'order',
            'items' => 'orderItem'
        ]);
});

require __DIR__.'/auth.php';
