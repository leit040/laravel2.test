<?php


namespace App\Service;


use App\Service\GeoIpInterface;
use Illuminate\Support\Facades\Http;
use MaxMind\Db\Reader;

class IpApiGeoService implements GeoIpInterface
{


    protected $data;


    public function parse($ip)
    {

        $response = Http::get('http://ip-api.com/json/' . $ip . '?fields=status,continentCode,countryCode');
        $this->data = $response->json();
    }


    public function continentCode()
    {
        return $this->data['continentCode'];
    }

    public function countryCode()
    {
        return $this->data['countryCode'];
    }


}
