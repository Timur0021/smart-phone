<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class CardList
{
    public static function make(): Block
    {
        return Block::make('cardlist')
            ->label('Список карток')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        ImageTitleSubtitleButtonItem::make(),
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
