<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
{
    $googleUser = Socialite::driver('google')
        ->stateless()
        ->user();

    $user = User::updateOrCreate(
        [
            'email' => $googleUser->email
        ],
        [
            'name'      => $googleUser->name,
            'google_id' => $googleUser->id,
            'avatar'    => $googleUser->avatar,
            'password'  => bcrypt('google-login'),
            'role'      => 'penyewa'
        ]
    );

    Auth::login($user);

    return redirect()->route('user.dashboard');
}
}