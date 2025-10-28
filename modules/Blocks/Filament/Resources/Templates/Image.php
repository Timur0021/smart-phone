<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;

class Image
{
    public static function make(): Block
    {
        return Block::make('image')
            ->label('Зображення')
            ->schema([
                FileUpload::make('image')
                    ->label('Зображення')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),
        ]);
    }
}
