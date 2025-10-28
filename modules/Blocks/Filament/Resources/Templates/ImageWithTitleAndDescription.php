<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ImageWithTitleAndDescription
{
    public static function make(): Block
    {
        return Block::make('image_with_title_and_description')
            ->label('Фото заголовок + опис')
            ->schema([
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        ImageWithTitleAndDescriptionItem::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
