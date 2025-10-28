<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class Services
{
    public static function make(): Block
    {
        return Block::make('services')
            ->label('Сервіси')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),

                Builder::make('items')
                    ->label('Елементи')
                ->blocks([
                    ServiceItem::make(),
                    DetailsItem::make(),
                ])->addActionLabel('Додати елемент'),
            ]);
    }
}
