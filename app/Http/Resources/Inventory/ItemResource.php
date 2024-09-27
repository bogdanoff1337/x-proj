<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $stickers = json_decode($this->stickers, true);

        return [
            'id'                 => $this->id,
            'user_id'            => $this->user_id,
            'icon_url'           => $this->icon_url,
            'assetid'            => $this->assetid,
            'classid'            => $this->classid,
            'instanceid'         => $this->instanceid,
            'market_hash_name'   => $this->market_hash_name,
            'name'               => $this->name,
            'steam_price'        => $this->steam_price,
            'type'               => $this->type,
            'float'              => $this->float,
            'stickers'           => [
                'image' => $stickers['image'] ?? null,
                'label' => $stickers['label'] ?? null,
            ],
        ];
    }
}
