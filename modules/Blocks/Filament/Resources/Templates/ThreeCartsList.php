<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ThreeCartsList
{
    public static function make(): Block
    {
        return Block::make('cards_list')
            ->label('Карточки')
            ->schema([
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        CardsItem::make()
                    ])->addActionLabel('Додати елемент'),
            ]);

    }
}
