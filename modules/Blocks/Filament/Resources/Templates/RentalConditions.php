<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class RentalConditions
{
    public static function make(): Block
    {
        return Block::make('rental_conditions')
            ->label(__('Умови прокати'))
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Назва'),
                ),
                Builder::make('items')
                    ->label('Елементи')
                ->blocks([
                    RentalConditionsItems::make(),
                ])->addActionLabel('Додати елемент'),
            ]);
    }
}
