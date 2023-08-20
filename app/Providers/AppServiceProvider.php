<?php

namespace App\Providers;

use App\Models\Products\Category;
use App\Models\Products\CategoryProduct;
use App\Models\Products\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();

        Model::unguard();

        Password::defaults(function () {
            $rule = Password::min(8);

            return $this->app->isProduction()
                ? $rule->mixedCase()->number()->symbols()->uncompromised()
                : $rule;
        });

        Relation::enforceMorphMap([
            'category' => Category::class,
            'category_product' => CategoryProduct::class,
            'product' => Product::class,
            'user' => User::class,
        ]);
    }
}
