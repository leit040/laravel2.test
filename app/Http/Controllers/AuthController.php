<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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


        return view('pages.auth.login', compact('gitHubLink', 'yahooLink'));


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
