<?php

namespace App\Console\Commands\Fetch;

use App\Models\Item;
use App\Services\Items\ItemsService;
use Illuminate\Console\Command;

class FetchPriceOfItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-price-of-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching price of items...');

        $items = Item::query()
            ->whereNull('steam_price')
            ->get();

        $progressBar = $this->output->createProgressBar($items->count());

        $items->chunk(100)->each(function ($items) use ($progressBar) {
            $items->each(function ($item) use ($progressBar) {
                $progressBar->advance();
                $price = app(ItemsService::class)->getItemPriceFromSteam($item->market_hash_name);

                $item->update([
                    'steam_price' => $price,
                ]);

            });
            $progressBar->finish();
        });
    }
}
