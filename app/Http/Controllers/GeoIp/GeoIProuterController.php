<?php


namespace App\Http\Controllers\GeoIp;


use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Providers\GeoIpServiceProvider;
use App\Service\GeoIpInterface;
use App\Service\MaxMindGeoService;
use App\Service\UserAgentInterface;

class GeoIpRouterController extends Controller
{
    protected $geoRoute;
    protected $agent;

    public function __construct(GeoIpInterface $geoRoute, UserAgentInterface $agent)
    {
        $this->geoRoute = $geoRoute;
        $this->agent = $agent;


    }


    public function route()
    {

        $ip = request()->ip() != '192.168.10.11' ?: request()->server->get('HTTP_X_FORWARDED_FOR');
        $this->geoRoute->parse($ip);
        $this->agent->parse(request()->server->get('HTTP_USER_AGENT'));

        Visit::create([
            'ip' => $ip,
            'continent_code' => $this->geoRoute->continentCode(),
            'country_code' => $this->geoRoute->countryCode(),
            'clientOs' => $this->agent->clientOs(),
            'clientBrowser' => $this->agent->clientBrowser(),

        ]);
        //давайте считать что тут есть редирект на куда то в зависимости от того с какой страны оно приперлось...
        return redirect()->route('post.index');

    }


}
