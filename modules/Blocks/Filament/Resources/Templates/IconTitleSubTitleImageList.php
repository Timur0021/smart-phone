<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class IconTitleSubTitleImageList
{
    public static function make(): Block
    {
        return Block::make('icon_title_subtitle_image_list')
            ->label('Іконка, заголовок, підзаголовок, фото')
            ->schema([
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        IconTitleSubTitleImageItem::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
