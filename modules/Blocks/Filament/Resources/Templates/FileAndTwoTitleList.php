<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class FileAndTwoTitleList
{
    public static function make(): Block
    {
        return Block::make('file_and_two_title_list')
            ->label('Файл + Два заголовки')
            ->schema([
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        FileTitleItem::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
