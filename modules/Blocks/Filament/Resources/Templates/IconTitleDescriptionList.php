<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class IconTitleDescriptionList
{
    public static function make(): Block
    {
        return Block::make('icon_title_description_list')
            ->label('Іконка, заголовок, опис, список')
            ->schema([
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        IconTitleDescriptionItem::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
