<?php

use App\Http\Controllers\Balance\BalanceController;
use App\Http\Controllers\Inventory\InventoryController;
use App\Http\Controllers\Items\ItemsController;
use App\Http\Controllers\Lot\LotController;
use App\Http\Controllers\Transactions\DepositController;
use App\Http\Controllers\Transactions\WithdrawController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => 'SteamAuthenticate'], function () {
    // user routes
    Route::post('user/trade-url', [UserController::class, 'update']);

    // inventory routes
    Route::get('inventory/{userId}', [InventoryController::class, 'getInventory']);
    Route::get('inventory/item/{marketHashName}', [InventoryController::class, 'getItemPriceByMarketHashName']);

    Route::post('withdraw', [WithdrawController::class, 'withdraw']);
    Route::post('deposit', [DepositController::class, 'deposit']);
    Route::get('balance/{user}', [BalanceController::class, 'getBalance']);

    Route::get('items/{steamId}', [ItemsController::class, 'getInventory']);
    Route::post('item/trade', [ItemsController::class, 'makeTradeOffer']);
    Route::post('item/trade/status', [ItemsController::class, 'tradeOfferStatus']);
    Route::get('item/price/{marketHashName}', [ItemsController::class, 'getItemPriceFromSteam']);
    Route::post('lot/create', [LotController::class, 'createLot']);
//});

Route::get('lots', [LotController::class, 'getLots']);
Route::get('lot/{id}', [LotController::class, 'getLot']);

