<?php

namespace App\Repositories\Inventory;

use Illuminate\Support\Collection;

interface InventoryRepositoryInterface
{
    public function getInventory(string $id): Collection;
}
