<?php


namespace App\Http\Controllers\OAuth;


use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class AuthGithubController
{
    public function __invoke()
    {


        $link = 'https://github.com/login/oauth/access_token';

        $parametres = [

            'client_id' => env('AUTH_GITHUB_CLIENT_ID'),
            'client_secret' => env('AUTH_GITHUB_CLIENT_SECRET'),
            'code' => request()->get('code'),
            'redirect_uri' => env('AUTH_GITHUB_REDIRECT_URI'),
        ];

        $link .= '?' . http_build_query($parametres);
        $response = Http::post($link);
        $data = [];
        parse_str($response->body(), $data);
        $response = Http::withHeaders(['Authorization' => 'token ' . $data['access_token']])->get('https://api.github.com/user');

        $userInfo = $response->json();


        $response = Http::withHeaders(['Authorization' => 'token ' . $data['access_token']])->get('https://api.github.com/user/emails');
        $userEmails = $response->json();

        if (($user = User::where('email', $userEmails[0]['email'])->first()) === NULL) {

            $faker = Factory::create();

            $data = [
                'name' => $userInfo['name'],
                'email' => $userEmails[0]['email'],
                'password' => Hash::make($faker->password)
            ];
            $user = User::create($data);


        }

        Auth::login($user);
        return redirect()->route('post.index');


    }
}
