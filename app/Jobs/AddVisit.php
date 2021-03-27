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
use Leit040\Geo\MaxMindGeoService;
use Leit040\Geo\UserAgentInterface;
use phpDocumentor\Reflection\Types\Null_;

class AddVisit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected UserAgentInterface $agent;
    public $ip;
    public $userAgent;


    public function __construct(UserAgentInterface $agent, $ip = null, $userAgent = null)
    {
        $this->onQueue('parsing');
        $this->agent = $agent;
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
     * @return void
     */
    public function handle()
    {

        $geoRoute = new MaxMindGeoService();
        $geoRoute->parse($this->ip);
        $this->agent->parse($this->userAgent);

        Visit::create([
            'ip' => $this->ip,
            'continent_code' => $geoRoute->continentCode(),
            'country_code' => $geoRoute->countryCode(),
            'clientOs' => $this->agent->clientOs(),
            'clientBrowser' => $this->agent->clientBrowser(),

        ]);
    }
}
