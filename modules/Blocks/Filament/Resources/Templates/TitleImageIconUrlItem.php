<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class TitleImageIconUrlItem
{
    public static function make(): Block
    {
        return Block::make('titleImageIconUrl_item')
            ->label('Заголовок+зображення+значок+URL-адреса')
            ->schema([
                FileUpload::make('image')
                    ->label('Зображення')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),
                FileUpload::make('icon')
                    ->label('Іконка')
                    ->disk('public')
                    ->directory('blocks/icons')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),

                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),

                TranslatableContainer::make(
                    TextInput::make('url')
                        ->label('URL-адреса'),
                ),
            ]);
    }
}
