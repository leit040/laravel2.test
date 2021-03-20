<?php


namespace App\Http\Controllers\OAuth;


use App\Models\User;
use Facade\FlareClient\Http\Response;
use Faker\Factory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class AuthFlickrController
{
    public function __invoke()
    {
        //  dd($_SESSION['data']['oauth_token_secret']);
        $data = request();
        //dd($data->all());
        $params = [
            'oauth_nonce' => $_SESSION['data']['nonce'],
            'oauth_timestamp' => $_SESSION['data']['timestamp'],
            'oauth_verifier' => $data['oauth_verifier'],
            'oauth_consumer_key' => env('AUTH_FLICKR_CLIENT_ID'),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_version' => '1.0',
            'oauth_token' => $data['oauth_token'],

        ];

        ksort($params);

        $baseStr = 'GET' . '&' . urlencode('https://www.flickr.com/services/oauth/access_token') . '&' . urlencode(http_build_query($params));
        $params['oauth_signature'] = base64_encode(hash_hmac('sha1', $baseStr, env('AUTH_FLICKR_CLIENT_SECRET') . "&" . $_SESSION['data']['oauth_token_secret'], true));
        $response = Http::get('https://www.flickr.com/services/oauth/access_token?' . urldecode(http_build_query($params)));

        parse_str($response->body(), $data);
        dd($data);

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
