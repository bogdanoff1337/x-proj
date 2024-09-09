<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function logout(): void
    {
        $this->authService->logout();
    }

    public function user(): ?Authenticatable
    {
        return $this->authService->user();
    }
}
