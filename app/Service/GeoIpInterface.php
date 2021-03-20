<?php


namespace App\Service;


interface GeoIpInterface
{
    public function continentCode();

    public function countryCode();

    public function parse($ip);

}
