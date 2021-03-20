<?php


namespace App\Http\Controllers\GeoIp;


use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Providers\GeoIpServiceProvider;
use App\Service\GeoIpInterface;
use App\Service\MaxMindGeoService;

class GeoIpRouterController extends Controller
{
    protected $geoRoute;

    public function __construct(GeoIpInterface $geoRoute)
    {
        $this->geoRoute = $geoRoute;

    }


    public function route()
    {

        $ip = request()->ip() != '192.168.10.11' ?: request()->server->get('HTTP_X_FORWARDED_FOR');


        $this->geoRoute->parse($ip);
        Visit::create([
            'ip' => $ip,
            'continent_code' => $this->geoRoute->continentCode(),
            'country_code' => $this->geoRoute->countryCode(),

        ]);
        //давайте считать что тут есть редирект на куда то в зависимости от того с какой страны оно приперлось...
        return redirect()->route('post.index');

    }


}
