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

        return view('pages.auth.login');


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
