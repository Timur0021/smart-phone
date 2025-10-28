<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class PayAndDeliveryList
{
    public static function make(): Block
    {
        return Block::make('pay_and_delivery_list')
            ->label('Оплата та доставка картки')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        PayAndDeliveryItem::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
