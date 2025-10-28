<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class FaqWithInputs
{
    public static function make(): Block
    {
        return Block::make('faq_with_inputs')
            ->label(__('FAQ з Заголовком'))
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label(__('Заголовок'))
                ),
                Builder::make('items')
                    ->label(__('Items'))
                    ->blocks([
                        FaqInputs::make(),
                    ])->addActionLabel(__('Додати блок')),
            ]);
    }
}
