<?php

namespace App\Repositories\Inventory;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface InventoryRepositoryInterface
{
    public function getInventory(string $id): LengthAwarePaginator;
    public function getItemPriceByMarketHashName(string $marketHashName): float;
}
