<?php

namespace Database\Seeders;

use App\Jobs\AddVisit;
use Illuminate\Database\Seeder;
use Leit040\Geo\GeoIpInterface;
use Leit040\Geo\IpApiGeoService;
use Leit040\Geo\MaxMindGeoService;
use Leit040\Geo\UserAgentGetBrowserService;
use Leit040\Geo\UserAgentInterface;
use Faker\Factory;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param $geoRoute
     * @param $agent
     * @return void
     */
    public function run()

    {
        $faker = Factory::create();
        $users = \App\Models\User::factory(10)->create();
        $categories = \App\Models\Category::factory(10)->create();
        $tags = \App\Models\Tag::factory(25)->create();


        \App\Models\Post::factory(10)->make(['category_id' => null, 'user_id' => null])->each(function ($post) use ($categories, $users, $tags) {
            $post->category_id = $categories->random()->id;
            $post->user_id = $users->random()->id;
            $post->save();
            $post->tags()->attach($tags->random(rand(5, 10))->pluck('id'));

        });

        $geoRoute = new MaxMindGeoService();
        $agent = new UserAgentGetBrowserService();
        for ($i = 0; $i < 1000; $i++) {
            AddVisit::dispatch($agent, $ip = $faker->ipv4, $userAgent = $faker->userAgent);
        }

    }
}
