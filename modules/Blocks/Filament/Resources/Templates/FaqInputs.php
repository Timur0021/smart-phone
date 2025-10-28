<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class FaqInputs
{
    public static function make(): Block
    {
        return Block::make('faq_input')
            ->label(__('Faq Поля'))
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('text_first')
                        ->label(__('Заголовок перший'))
                ),
                TranslatableContainer::make(
                    TextInput::make('text_second')
                        ->label(__('Заголовок другий'))
                ),
                TranslatableContainer::make(
                    TextInput::make('text_third')
                        ->label(__('Заголовок третій'))
                ),
            ]);
    }
}
