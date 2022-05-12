<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\ServiceProvider;

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
    }
}
