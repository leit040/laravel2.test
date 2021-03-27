<?php

namespace App\Providers;


use  Leit040\Geo\GeoIpInterface;
use Leit040\Geo\IpApiGeoService;
use Illuminate\Support\ServiceProvider;
use Leit040\Geo\MaxMindGeoService;

class GeoIpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {


        $this->app->singleton(GeoIpInterface::class, function () {
            return new MaxMindGeoService();

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
