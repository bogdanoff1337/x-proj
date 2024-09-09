<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transactions\DepositController;
use App\Http\Controllers\Transactions\WithdrawController;
use App\Http\Controllers\Balance\BalanceController;
use App\Http\Controllers\Items\ItemsController;
use App\Http\Controllers\Lot\LotController;

//Route::group(['middleware' => 'SteamAuthenticate'], function () {
    Route::post('deposit', [DepositController::class, 'deposit']);
    Route::post('withdraw', [WithdrawController::class, 'withdraw']);
    Route::get('balance/{user}', [BalanceController::class, 'getBalance']);

    Route::get('items/{steamId}', [ItemsController::class, 'getInventory']);
    Route::post('item/trade', [ItemsController::class, 'makeTradeOffer']);
    Route::post('item/trade/status', [ItemsController::class, 'tradeOfferStatus']);
    Route::get('item/price/{marketHashName}', [ItemsController::class, 'getItemPriceFromSteam']);
    Route::post('lot/create', [LotController::class, 'createLot']);
//});

Route::get('lots', [LotController::class, 'getLots']);
Route::get('lot/{id}', [LotController::class, 'getLot']);

