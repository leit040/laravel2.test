<?php

namespace App\Jobs;

use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Leit040\Geo\GeoIpInterface;
use Leit040\Geo\UserAgentInterface;


class AddVisit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $ip;
    private $userAgent;


    public function __construct($ip = null, $userAgent = null)
    {


        $this->onQueue('parsing');
        if ($ip != null) {
            $this->ip = $ip;
        } else {
            $this->ip = request()->ip() != '192.168.10.11' ?: request()->server->get('HTTP_X_FORWARDED_FOR');
        }
        if ($userAgent != null) {
            $this->userAgent = $userAgent;
        } else {

            $this->userAgent = request()->server->get('HTTP_USER_AGENT');
        }


    }

    /**
     * Execute the job.
     *
     * @param GeoIpInterface $geoService
     * @param UserAgentInterface $agent
     * @return void
     */
    public function handle(GeoIpInterface $geoService, UserAgentInterface $agent)
    {


        $geoService->parse($this->ip);
        $agent->parse($this->userAgent);

        Visit::create([
            'ip' => $this->ip,
            'continent_code' => $geoService->continentCode(),
            'country_code' => $geoService->countryCode(),
            'clientOs' => $this->agent->clientOs(),
            'clientBrowser' => $this->agent->clientBrowser(),

        ]);
    }
}
