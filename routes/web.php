<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SteamAuthController;

Route::group(['prefix' => 'auth'], function() {
    Route::get('steam', [SteamAuthController::class, 'redirectToSteamProvider'])->name('steam.login');
    Route::get('steam/callback', [SteamAuthController::class, 'handleSteamProviderCallback']);
    Route::post('logout', [SteamAuthController::class, 'logout']);
    Route::get('user', [SteamAuthController::class, 'user']);
});
