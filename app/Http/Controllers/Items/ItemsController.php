<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Items\ItemsService;
use App\Models\Item;

class ItemsController extends Controller
{
    protected $steamInventoryService;

    public function __construct(ItemsService $steamInventoryService)
    {
        $this->steamInventoryService = $steamInventoryService;
    }

    public function getInventory($steamId): array
    {
        return $this->steamInventoryService->getInventory($steamId);
    }

    public function getItemPriceFromSteam($marketHashName)
    {
        return $this->steamInventoryService->getItemPriceFromSteam($marketHashName);
    }

    public function makeTradeOffer(Request $request)
    {
        return $this->steamInventoryService->makeTradeOffer();
    }

    public function tradeOfferStatus(Request $request)
    {
        return $this->steamInventoryService->tradeOfferStatus($request);
    }
}
