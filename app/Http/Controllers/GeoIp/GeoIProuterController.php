<?php


namespace App\Http\Controllers\GeoIp;


use App\Http\Controllers\Controller;
use App\Jobs\AddVisit;
use App\Models\Visit;
use App\Providers\GeoIpServiceProvider;
use GeoIp2\Exception\AddressNotFoundException;
use Leit040\Geo\GeoIpInterface;
use Leit040\Geo\MaxMindGeoService;
use Leit040\Geo\UserAgentInterface;


class GeoIProuterController extends Controller
{
    protected GeoIpInterface $geoRoute;
    protected UserAgentInterface $agent;

    public function __construct(GeoIpInterface $geoRoute, UserAgentInterface $agent)
    {
        $this->geoRoute = $geoRoute;
        $this->agent = $agent;


    }


    public function route()
    {

        $queue = new AddVisit($this->agent);
        $queue->onQueue('parsing')->dispatch($this->agent);

        return redirect()->route('post.index');


        /*  $ip = request()->ip() != '192.168.10.11' ?: request()->server->get('HTTP_X_FORWARDED_FOR');
          $this->geoRoute->parse($ip);
          $this->agent->parse(request()->server->get('HTTP_USER_AGENT'));

          Visit::create([
              'ip' => $ip,
              'continent_code' => $this->geoRoute->continentCode(),
              'country_code' => $this->geoRoute->countryCode(),
              'clientOs' => $this->agent->clientOs(),
              'clientBrowser' => $this->agent->clientBrowser(),

          ]);*/
        //давайте считать что тут есть редирект на куда то в зависимости от того с какой страны оно приперлось...
        // return redirect()->route('post.index');

    }


}
