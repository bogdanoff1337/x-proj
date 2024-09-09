<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;
    protected static ?string $navigationGroup = 'Айтеми';
    protected static ?string $navigationLabel = 'Айтеми';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Користувач')
                    ->options(fn () => User::query()->pluck('nickname', 'id')),
                TextInput::make('name')
                    ->label('Назва')
                    ->required(),
                TextInput::make('description')
                    ->label('Опис')
                    ->required(),
                TextInput::make('market_hash_name')
                    ->label('Назва на ринку')
                    ->required(),
                TextInput::make('steam_price')
                    ->label('Ціна на ринку')
                    ->required(),
                TextInput::make('type')
                    ->label('Тип')
                    ->required(),
                TextInput::make('float')
                    ->label('Флоат')
                    ->required(),
                TextInput::make('assetid')
                    ->label('assetid')
                    ->required(),
                TextInput::make('classid')
                    ->label('classid')
                    ->required(),
                TextInput::make('instanceid')
                    ->label('instanceid')
                    ->required(),
                FileUpload::make('icon_url')
                    ->image()
                    ->label('Картинка'),
                RichEditor::make('stickers')
                    ->label('Стікери')
                    ->disabled()
                    ->toolbarButtons([]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Назва'),
                ImageColumn::make('icon_url')
                    ->label('Image'),
                TextColumn::make('steam_price')
                    ->sortable()
                    ->label('Ціна на ринку' . ' ' . env('CURRENCY')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
