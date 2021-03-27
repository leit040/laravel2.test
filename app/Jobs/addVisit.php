<?php

namespace App\Jobs;

use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Leit040\Geo\GeoIpInterface;
use Leit040\Geo\UserAgentInterface;

class addVisit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $geoRoute;
    protected $agent;

    public function __construct(GeoIpInterface $geoRoute, UserAgentInterface $agent)
    {
        $this->geoRoute = $geoRoute;
        $this->agent = $agent;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
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
    }
}
