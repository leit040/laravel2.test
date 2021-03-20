<?php

namespace App\Providers;

use App\Service\MaxMindGeoService;
use Illuminate\Support\ServiceProvider;
use MaxMind\Db\Reader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
