<?php


namespace App\Http\Controllers\OAuth;


use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class AuthYahooController
{
    public function __invoke()
    {


        $link = 'https://api.login.yahoo.com/oauth2/get_token';

        $parametres = [

            'grant_type' => 'authorization_code',
            'client_id' => env('AUTH_YAHOO_CLIENT_ID'),
            'client_secret' => env('AUTH_YAHOO_CLIENT_SECRET'),
            'code' => request()->get('code'),
            'redirect_uri' => env('AUTH_YAHOO_REDIRECT_URI'),


        ];


        $response = Http::withHeaders(['Authorization' => 'Basic ' . base64_encode(env('AUTH_YAHOO_CLIENT_ID') . ':' . env('AUTH_YAHOO_CLIENT_SECRET')), 'Content-Type' => 'application/x-www-form-urlencoded'])->
        asForm()->post($link, [

            'grant_type' => 'authorization_code',
            'client_id' => env('AUTH_YAHOO_CLIENT_ID'),
            'client_secret' => env('AUTH_YAHOO_CLIENT_SECRET'),
            'code' => request()->get('code'),
            'redirect_uri' => env('AUTH_YAHOO_REDIRECT_URI'),


        ]);


        $data = $response->json();
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $data['access_token']])->get('https://api.login.yahoo.com/openid/v1/userinfo');
        $userInfo = $response->json();


        if (($user = User::where('email', $userInfo['email'])->first()) === NULL) {

            $faker = Factory::create();

            $data = [
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                'password' => Hash::make($faker->password)
            ];
            $user = User::create($data);


        }

        Auth::login($user);
        return redirect()->route('post.index');


    }
}
