<?php

namespace App\Services\Inventory;

use App\Repositories\Inventory\InventoryRepositoryInterface;
use Illuminate\Support\Collection;

class InventoryService
{
    public function __construct(
        protected InventoryRepositoryInterface $inventoryRepository
    ){
    }

    public function getInventory(string $id): Collection
    {
        return $this->inventoryRepository->getInventory($id);
    }
}
