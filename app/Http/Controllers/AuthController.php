<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{


    public function login()
    {

        $gitHubLink = 'https://github.com/login/oauth/authorize';
        $parametres = [

            'client_id' => env('AUTH_GITHUB_CLIENT_ID'),
            'redirect_uri' => env('AUTH_GITHUB_REDIRECT_URI'),
            'scope' => 'user,user:email'

        ];
        $gitHubLink .= '?' . http_build_query($parametres);

        $yahooLink = 'https://api.login.yahoo.com/oauth2/request_auth';
        $parametres = [

            'client_id' => env('AUTH_YAHOO_CLIENT_ID'),
            'redirect_uri' => env('AUTH_YAHOO_REDIRECT_URI'),
            'response_type' => 'code'


        ];
        $yahooLink .= '?' . http_build_query($parametres);

        $oauth_nonce = time();
        $oauth_timestamp = time();

        $base_string = "GET&https://www.flickr.com/services/oauth/request_token
?oauth_nonce=" . $oauth_nonce . "
&oauth_timestamp=" . $oauth_timestamp . "
&oauth_consumer_key=" . env('AUTH_FLICKR_CLIENT_ID') . "
&oauth_signature_method=HMAC-SHA1
&oauth_version=1.0
&oauth_callback=" . env('AUTH_FLICKR_REDIRECT_URI');

        $oauth_signature = hash_hmac("SHA1", rawurlencode($base_string), env('AUTH_FLICKR_CLIENT_SECRET') . '&', false);

        $flickrLink = "https://www.flickr.com/services/oauth/request_token
?oauth_nonce=$oauth_nonce
&oauth_timestamp=$oauth_timestamp
&oauth_consumer_key=" . env('AUTH_FLICKR_CLIENT_ID') . "
&oauth_signature_method=HMAC-SHA1
&oauth_version=1.0
&oauth_signature=$oauth_signature
&oauth_callback=" . env('AUTH_FLICKR_REDIRECT_URI');


        return view('pages.auth.login', compact('gitHubLink', 'yahooLink', 'flickrLink'));


    }


    public function loginHandle(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();


            if (Hash::needsRehash(User::find(Auth::id())->password)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->only('password')['password']);
                $user->update();


            }

            return new RedirectResponse(route('index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('index');
    }

}
