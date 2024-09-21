<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService
    ){
    }

    public function getInventory(Request $request, $id): Collection
    {
        return $this->inventoryService->getInventory($id);
    }
}
