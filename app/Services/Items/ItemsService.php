<?php

namespace App\Services\Items;

use App\Models\SteamItemPrice;
use App\Models\TradeHistory;
use DOMDocument;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use SteamApi\SteamApi;

class ItemsService
{
    protected $client;
    protected $api;
    public function __construct()
    {
        $this->api = new SteamApi();
        $this->client = new Client();
    }

    public function getInventory(string $steamId): array
    {
        $url = "https://steamcommunity.com/inventory/{$steamId}/730/2";

        $response = $this->client->request('GET', $url, [
            'query' => [
                'l' => 'english',
                'count' => 5000,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $this->combineInventoryData($data);
    }

    private function combineInventoryData($data): array
    {
        $combinedData = $this->combineAssetsAndDescriptions($data);
        $returnData = [];
        foreach ($combinedData as $classid => $data) {
            preg_match('/\((.*?)\)/', $data['description']['market_name'], $matches);

            $stickers = $this->getStickers($data['description']['descriptions']);
            $type = $data['description']['tags'][0]['localized_tag_name'] ?: null;

            $returnData[] = [
                'assetid'          => (int) $data['asset']['assetid'] ?? null,
                'classid'          => $classid,
                'instanceid'       => (int)  $data['asset']['instanceid'] ?? null,
                'name'             => $data['description']['name'] ?? null,
                'market_hash_name' => $data['description']['market_name'] ?? null,
                'type'             => $type,
                'icon_url'         => 'https://community.akamai.steamstatic.com/economy/image/' . $data['description']['icon_url'] ?? null,
                'stickers'         => $stickers,
            ];
        }

        return $returnData;
    }

    private function combineAssetsAndDescriptions($data): array
    {
        $combinedData = [];

        foreach ($data['assets'] as $asset) {
            $classid = $asset['classid'];
            if (!isset($combinedData[$classid])) {
                $combinedData[$classid] = [];
            }
            $combinedData[$classid]['asset'] = $asset;
        }

        foreach ($data['descriptions'] as $description) {
            $classid = $description['classid'];
            if (!isset($combinedData[$classid])) {
                $combinedData[$classid] = [];
            }
            $combinedData[$classid]['description'] = $description;

        }

        return $combinedData;
    }

    protected function getStickers($data): ?string
    {
        if (!isset($data[6])) {
            return null;
        }

        $stickersHtml = $data[6]['value'];
        $dom = new DOMDocument();
        @$dom->loadHTML($stickersHtml);

        $stickers = [];
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $index => $img) {
            $src = $img->getAttribute('src');

            $labelText = $dom->textContent;
            $labels = explode(', ', trim(substr($labelText, strpos($labelText, 'Sticker:') + 8)));

            $stickers[] = [
                'image' => $src,
                'label' => $labels[$index] ?? 'Sticker ' . ($index + 1),
            ];
        }

        return json_encode($stickers);
    }


    public function getItemPriceFromSteam($marketHashName): ?float
    {
        if ($price = SteamItemPrice::where('market_hash_name', $marketHashName)->first()) {
            return $price->price;
        }

        $url = "https://steamcommunity.com/market/priceoverview/";

        $params = [
            'appid' => 730,
            'market_hash_name' => $marketHashName,
            'currency' => 1, // USD currency
        ];

        $response = $this->client->request('GET', $url, [
            'query' => $params,
        ]);

        $data = json_decode($response->getBody(), true);
        $price = str_replace('$', '', $data['lowest_price']) ?? null;
        dump($marketHashName);
        SteamItemPrice::create([
            'market_hash_name' => $marketHashName,
            'price' => $price,
        ]);

        return (float) str_replace('$', '', $data['lowest_price']);
    }

    public function getItemFromInventory()
    {
        $url = "https://steamcommunity.com/inventory/76561198869596453/730/2";

        $response = $this->client->request('GET', $url, [
            'query' => [
                'l' => 'english',
                'count' => 5000,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $this->combineInventoryData($data);
    }

    public function makeTradeOffer(): JsonResponse
    {
        $cookies =
            'sessionid=d60a6991da2f15f83cd4dd3d;
            steamCountry=UA%7Cd39dbe467f7618d8e8beff41ae0904d7;
            steamLoginSecure=76561198877044347%7C%7CeyAidHlwIjogIkpXVCIsICJhbGciOiAiRWREU0EiIH0.eyAiaXNzIjogInI6MEY4RV8yNEM4N0NCRV8wRTIxMSIsICJzdWIiOiAiNzY1NjExOTg4NzcwNDQzNDciLCAiYXVkIjogWyAid2ViOmNvbW11bml0eSIgXSwgImV4cCI6IDE3MjE4NDQxMTIsICJuYmYiOiAxNzEzMTE3NDMzLCAiaWF0IjogMTcyMTc1NzQzMywgImp0aSI6ICIwRjhGXzI0Qzg3Q0JFXzIyODBDIiwgIm9hdCI6IDE3MjE3NTc0MzMsICJydF9leHAiOiAxNzM5ODcwOTc1LCAicGVyIjogMCwgImlwX3N1YmplY3QiOiAiMTc2LjExMS4xODcuMjciLCAiaXBfY29uZmlybWVyIjogIjE3Ni4xMTEuMTg3LjI3IiB9.Yn5tlATHXzCS5rt-_ZNV-GO8Z91_ym1omiLbCYah750yGGQd97oqDoPs6ddjo0BgXSQn76j0YfB-xX-T4jWTDA;';

        $tradeLink = "https://steamcommunity.com/tradeoffer/new/?partner=909330725&token=3jX93lDE";

        $formData = [
            'partner_id' => '76561198869596453',
            'message' => 'message',
            'my_items' => [
                [
                    "app_id" => 730,
                    "context_id" =>  "2",
                    "amount" =>  1,
                    "asset_id" => '38833834173'
                ],
            ],
            'partner_items' => []
        ];

        $response =  $this->api->detailed()
            ->withCookies($cookies)
            ->createTradeOffer($tradeLink, $formData);

        $tradeId = Arr::get($response, 'response.tradeofferid');

        $tradeOfferInfo = TradeHistory::create([
            'user_id' => 1,
            'item_id' => $formData['my_items'][0]['asset_id'],
            'bot_id' => 1,
            'trade_id' => $tradeId,
        ]);

        return response()->json([
            'trade_id'         => $tradeId,
            'trade_offer_info' => $tradeOfferInfo,
        ]);
    }

    public function tradeOfferStatus($tradeOfferId)
    {
        $cookies =
            'sessionid=d60a6991da2f15f83cd4dd3d;
            steamCountry=UA%7Cd39dbe467f7618d8e8beff41ae0904d7;
            steamLoginSecure=76561198869596453%7C%7CeyAidHlwIjogIkpXVCIsICJhbGciOiAiRWREU0EiIH0.eyAiaXNzIjogInI6MEY4Rl8yNEM4N0NCRV81Nzc1MyIsICJzdWIiOiAiNzY1NjExOTg4Njk1OTY0NTMiLCAiYXVkIjogWyAid2ViOmNvbW11bml0eSIgXSwgImV4cCI6IDE3MjE4NDYwNTAsICJuYmYiOiAxNzEzMTE4NzI1LCAiaWF0IjogMTcyMTc1ODcyNSwgImp0aSI6ICIwRjg5XzI0Qzg3RDAwXzdGNkRGIiwgIm9hdCI6IDE3MjE3NTg3MjUsICJydF9leHAiOiAxNzM5ODk5MjEzLCAicGVyIjogMCwgImlwX3N1YmplY3QiOiAiMTc2LjExMS4xODcuMjciLCAiaXBfY29uZmlybWVyIjogIjE3Ni4xMTEuMTg3LjI3IiB9.tSbut8behq-EqwyQs4VUaUWoRKOyx8nsAE14_hKCbvB5hDc240h3Pi5kZEUXl_yxClBMOzTFikkDkSGYmS2bBw';

        $tradeOfferId = '7255497633';

        dd($this->api->detailed()
            ->withCookies($cookies)                                                      // or with cookies from string or array
            ->getTradeReceipt($tradeOfferId));
    }
}
