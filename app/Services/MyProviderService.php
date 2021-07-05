<?php

namespace App\Services;

use App\Services\FooService;
use Illuminate\Support\ServiceProvider;

class MyProviderService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('FooService',function(){
            return new FooService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
