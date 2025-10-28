<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class PayAndDeliveryItem
{
    public static function make(): Block
    {
        return Block::make('pay_and_delivery_item')
            ->label('Оплата та доставка список')
            ->schema([
                FileUpload::make('image')
                    ->label('Зображення')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),
                TranslatableContainer::make(
                    TextInput::make('sub_title')
                        ->label('Підзаголок'),
                ),
                TranslatableContainer::make(
                    TinyEditor::make('description')
                        ->label('Опис')
                        ->profile('default')
                        ->columnSpanFull(),
                ),
            ]);
    }
}
