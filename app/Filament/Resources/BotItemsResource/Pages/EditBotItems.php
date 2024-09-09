<?php

namespace App\Filament\Resources\BotItemsResource\Pages;

use App\Filament\Resources\BotItemsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBotItems extends EditRecord
{
    protected static string $resource = BotItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
