<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SteamAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('steam.login');
        }

        return $next($request);
    }
}
