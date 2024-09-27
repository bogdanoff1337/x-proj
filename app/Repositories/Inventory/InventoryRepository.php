<?php

namespace App\Repositories\Inventory;

use App\Helpers\InventoryHelper;
use App\Models\Item;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class InventoryRepository implements InventoryRepositoryInterface
{
    protected $inventoryHelper;

    public function __construct()
    {
        $this->inventoryHelper = new InventoryHelper();
    }

    public function getInventory(string $id): LengthAwarePaginator
    {
        return Item::query()->where('user_id', $id)->paginate();
    }

    public function getItemPriceByMarketHashName(string $marketHashName): float
    {
        dd($marketHashName);
        $fromDataBase = Item::query()
            ->where('market_hash_name', $marketHashName)
            ->first()
            ->steam_price;

        if ($fromDataBase) {
            return $this->inventoryHelper->getItemPriceFromSteam($marketHashName);
        }

//        return response()->json(['error' => 'Item not found'], 404);
    }
}
