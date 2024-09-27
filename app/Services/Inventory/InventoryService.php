<?php

namespace App\Services\Inventory;

use App\Repositories\Inventory\InventoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InventoryService
{
    public function __construct(
        protected InventoryRepositoryInterface $inventoryRepository
    ){
    }

    public function getInventory(string $id): LengthAwarePaginator
    {
        return $this->inventoryRepository->getInventory($id);
    }

    public function getItemPriceByMarketHashName(string $marketHashName): int
    {
        return $this->inventoryRepository->getItemPriceByMarketHashName($marketHashName);
    }
}
