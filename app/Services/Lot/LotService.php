<?php

namespace App\Services\Lot;

use App\Models\Lots;
use App\Services\Items\ItemsService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LotService
{
    protected $lotService;

    public function __construct(ItemsService $itemsService)
    {
        $this->lotService = $itemsService;
    }

    public function getLots()
    {
        return Lots::query()->paginate();
    }

    public function getLot($id)
    {
        return Lots::query()->findOrFail($id);
    }

    public function createLot(Request $request)
    {

    }

    private function parseItemInfo($inventory)
    {
        $ids = $inventory['assets'];

        foreach ($ids as $id) {
            $assetid = Arr::get($id, 'assetid');
            $classid = Arr::get($id, 'classid');
            $instanceid = Arr::get($id, 'instanceid');
        }

        $base_info = $inventory['descriptions'];

        foreach ($base_info as $info) {
            $id = Arr::get($info, 'classid');
            $name = Arr::get($info, 'name');
            $type = Arr::get($info, 'type');
        }

        $item = [
            'id' => $assetid,
            'name' => $name,
            'type' => $type,
        ];
        $name = $inventory['assets'][0]['name'];
    }

}
