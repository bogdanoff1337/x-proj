<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SteamAuthService
{
    public function redirectToSteamProvider(): RedirectResponse
    {
        return Socialite::driver('steam')->redirect();
    }

    public function handleSteamProviderCallback(): RedirectResponse
    {
        $steamUser = Socialite::driver('steam')->user();
        $userInfo = $steamUser->user;

        $user = User::updateOrCreate(
            ['steam_id' => $steamUser->id],
            [
                'profile_url' => Arr::get($userInfo, 'profileurl'),
                'nickname' => $steamUser->nickname,
                'avatar' => $steamUser->avatar,
            ]
        );

        Auth::login($user, true);

        session(['steam_user' => $user]);

        return redirect()->intended();
    }


    public function logout(): void
    {
        Auth::logout();
    }

    public function user(): ?Authenticatable
    {
        return Auth::user();
    }
}
