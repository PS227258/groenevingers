<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Http;

class OAuthLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->email)->first();
        if(!$user)
        {
            return view("auth.login");
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        $user = User::where('email', $githubUser->email)->first();

        if(!$user)
        { 
            return view("auth.login");
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}