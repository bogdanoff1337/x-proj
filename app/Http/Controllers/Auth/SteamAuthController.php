<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\SteamAuthService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;

class SteamAuthController extends Controller
{
    protected $authService;

    public function __construct(SteamAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function redirectToSteamProvider(): RedirectResponse
    {
        return $this->authService->redirectToSteamProvider();
    }

    public function handleSteamProviderCallback(): RedirectResponse
    {
        return $this->authService->handleSteamProviderCallback();
    }

    public function logout()
    {
        $this->authService->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function user()
    {
        $user = $this->authService->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::query()
            ->where('id', $user->id)
            ->with('wallet')
            ->first();
        $money = round($user->wallet->balance, $user->wallet->decimal_places);
        $formattedMoney = number_format($money / 100, 2);
        $user->money = $formattedMoney;

        return response()->json(['data'  => $user]);
    }
}
