<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $googleUser =
        Socialite::driver('google')->user();

        $user = User::updateOrCreate(

            [
                'email' => $googleUser->getEmail()
            ],

            [
                'nama' => $googleUser->getName(),

                'username' => $googleUser->getEmail(),

                'password' => bcrypt('google-login'),

                'role' => 'user',

                'poin' => 0
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}