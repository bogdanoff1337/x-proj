<?php

namespace App\Console\Commands\Fetch;

use App\Models\Item;
use App\Models\User;
use App\Models\UserItems;
use App\Services\Items\ItemsService;
use Illuminate\Console\Command;

class FetchInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-inventory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'for fetching inventory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching inventory...');

        $user = User::find(1);

        $items = app(ItemsService::class)->getInventory($user->steam_id);

        $excludedPatterns = [
            '/\b5 Year Veteran Coin\b/i',
            '/\bMusic Kit\b.*\bValve, CS:GO\b/i',
            '/\bGlobal Offensive Badge\b/i',
            '/\bService Medal\b/i',
            '/\bBirthday Coin\b/i',
            '/\bDiamond Operation\b.*\bCoin\b/i',
        ];

        foreach ($items as $item) {
            $exclude = false;
            foreach ($excludedPatterns as $pattern) {
                if (preg_match($pattern, $item['name'])) {
                    $exclude = true;
                    break;
                }
            }

            if ($exclude) {
                $this->info('Item ' . $item['name'] . ' skipped');
                continue;
            }
            Item::firstOrCreate([
                'assetid' => $item['assetid'],
            ], [
                'classid' => $item['classid'],
                'instanceid' => $item['instanceid'],
                'name' => $item['name'],
                'market_hash_name' => $item['market_hash_name'],
                'type' => $item['type'],
                'icon_url' => $item['icon_url'],
                'stickers' => $item['stickers'] ?? null,
            ]);

            UserItems::firstOrCreate([
                'user_id' => $user->id,
                'item_id' => Item::where('assetid', $item['assetid'])->first()->id,
            ]);

            $this->info('Item ' . $item['name'] . ' added');
        }
        $this->info('Inventory fetched successfully');
    }

}
