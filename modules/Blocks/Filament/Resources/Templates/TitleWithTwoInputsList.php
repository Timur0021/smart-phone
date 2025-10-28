<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class TitleWithTwoInputsList
{
    public static function make(): Block
    {
        return Block::make('title_with_titles_list')
            ->label('Заголовок з списком заголовків')
            ->schema([
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        TitleWithTwoTitleItem::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
