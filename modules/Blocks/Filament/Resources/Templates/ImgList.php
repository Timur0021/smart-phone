<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ImgList
{
    public static function make(): Block
    {
        return Block::make('image_list')
            ->label('Фото галерея')
            ->schema([
                Repeater::make('image_item')
                    ->label('Деталі блоку')
                    ->columnSpanFull()
                    ->defaultItems(0)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Зображення')
                            ->disk('public')
                            ->directory('blocks')
                            ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),
                    ]),
            ]);
    }
}
