<?php

namespace App\Helpers;

use App\Models\SteamItemPrice;
use GuzzleHttp\Client;
use SteamApi\SteamApi;

class InventoryHelper
{
    protected $client;
    protected $api;

    public function __construct()
    {
        $this->api = new SteamApi();
        $this->client = new Client();
    }

    public function getItemPriceFromSteam($marketHashName): ?float
    {
        $price = SteamItemPrice::query()
            ->where('market_hash_name', $marketHashName)
            ->first();

        if ($price) {
            return $price->price;
        }

        $url = "https://steamcommunity.com/market/priceoverview/";

        $params = [
            'appid'            => 730,
            'market_hash_name' => $marketHashName,
            'currency'         => 1, // USD currency
        ];

        $response = $this->client->request('GET', $url, [
            'query' => $params,
        ]);

        $data  = json_decode($response->getBody(), true);
        $price = str_replace('$', '', $data['lowest_price']) ?? null;

        SteamItemPrice::query()->create([
            'market_hash_name' => $marketHashName,
            'price'            => $price,
        ]);

        return (float) str_replace('$', '', $data['lowest_price']);
    }
}
