<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class CardWithCounter
{
    public static function make(): Block
    {
        return Block::make('cardWithCounter_item')
            ->label('Корзина з кількістю елементів')
            ->schema([
                FileUpload::make('icon')
                    ->label('Іконка')
                    ->disk('public')
                    ->directory('blocks/icons')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),
                TextInput::make('prefix')
                    ->label('Прифікс'),
                TextInput::make('sufix')
                    ->label('Суфікс'),
                TextInput::make('number')
                    ->label('Номер'),
                TranslatableContainer::make(
                    TextInput::make('subtitle')
                        ->label('Підзаголовок'),
                ),
            ]);
    }
}
