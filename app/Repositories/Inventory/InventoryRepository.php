<?php

namespace App\Repositories\Inventory;

use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Collection;

class InventoryRepository implements InventoryRepositoryInterface
{
    public function getInventory(string $id): Collection
    {
        return Item::query()->where('user_id', $id)->get();
    }
}
