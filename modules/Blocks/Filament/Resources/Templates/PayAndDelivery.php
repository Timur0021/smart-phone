<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;

class PayAndDelivery
{
    public static function make(): Block
    {
        return Block::make('pay_and_delivery')
            ->label('Оплата та доставка')
            ->schema([
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        PayAndDeliveryList::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
