<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class File
{
    public static function make(): Block
    {
        return Block::make('file')
            ->label('Назва + Файл')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title_file')
                        ->label('Назва до Файлу'),
                ),
                FileUpload::make('file')
                    ->label('Файл')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),
        ]);
    }
}
