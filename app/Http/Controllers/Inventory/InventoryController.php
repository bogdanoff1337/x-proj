<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService
    ){
    }

    public function getInventory(Request $request, $id): LengthAwarePaginator
    {
        return $this->inventoryService->getInventory($id);
    }

    public function getItemPriceByMarketHashName(Request $request, $marketHashName): float
    {
        dd($marketHashName);
        return $this->inventoryService->getItemPriceByMarketHashName($marketHashName);
    }
}
