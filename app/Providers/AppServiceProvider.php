<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
        Validator::extend('phone_no', function ($attribute, $value, $parameters, $validator) {
            // Your custom validation logic for phone_no here
            return preg_match('/^[0-9]{10}$/', $value) === 1;
        });
    }
}
