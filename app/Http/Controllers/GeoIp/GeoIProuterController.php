<?php


namespace App\Http\Controllers\GeoIp;


use App\Http\Controllers\Controller;
use App\Jobs\AddVisit;
use Leit040\Geo\GeoIpInterface;
use Leit040\Geo\UserAgentInterface;


class GeoIProuterController extends Controller
{
    protected GeoIpInterface $geoService;
    protected UserAgentInterface $agent;




    public function route()
    {

        $queue = new AddVisit();
        $queue->onQueue('parsing')->dispatch();

        return redirect()->route('post.index');


    }


}
