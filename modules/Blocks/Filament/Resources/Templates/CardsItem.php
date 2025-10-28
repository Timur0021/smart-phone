<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;
use Filament\Forms\Components\Builder;

class CardsItem
{
    public static function make(): Block
    {
        return Block::make('cards_list')
            ->label('Заголовок + Файл Список')
            ->schema([
                /*
              * checkbox for condition
              */
                Checkbox::make('state_one')
                    ->label('Карточка 1')
                    ->reactive(),

                Checkbox::make('state_two')
                    ->label('Карточка 2')
                    ->reactive(),

                Checkbox::make('state_three')
                    ->label('Карточка 3')
                    ->reactive(),

                /*
                 * first condition
                 */
                TranslatableContainer::make(
                    TextInput::make('title_first')
                        ->label('Заголовок Перший'),
                )->visible(fn ($get) => $get('state_one')),

                TranslatableContainer::make(
                    TextInput::make('title_second')
                        ->label('Заголовок Другий')
                )->visible(fn ($get) => $get('state_one')),

                TranslatableContainer::make(
                    TextInput::make('title_button_first')
                        ->label('Заголовок Кнопки'),
                )->visible(fn ($get) => $get('state_one')),

                TextInput::make('link_button_first')
                    ->label('Посилання Кнопки')
                    ->visible(fn ($get) => $get('state_one')),

                FileUpload::make('image')
                    ->label('Головне Фото')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE)
                    ->visible(fn ($get) => $get('state_one')),

                FileUpload::make('image_two')
                    ->label('Фото перше')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE)
                    ->visible(fn ($get) => $get('state_one')),

                FileUpload::make('image_third')
                    ->label('Фото друге')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE)
                    ->visible(fn ($get) => $get('state_one')),

                FileUpload::make('image_forth')
                    ->label('Фото третє')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE)
                    ->visible(fn ($get) => $get('state_one')),

                FileUpload::make('image_five')
                    ->label('Фото четверте')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE)
                    ->visible(fn ($get) => $get('state_one')),


                /*
                * second condition
                */
                TranslatableContainer::make(
                    TextInput::make('title_block_second_first')
                        ->label('Заголовок Перший'),
                )->visible(fn ($get) => $get('state_two')),

                TranslatableContainer::make(
                    TextInput::make('title_block_second_second')
                        ->label('Заголовок Другий')
                )->visible(fn ($get) => $get('state_two')),

                TranslatableContainer::make(
                    TextInput::make('title_block_second_three')
                        ->label('Заголовок Третій')
                )->visible(fn ($get) => $get('state_two')),

                TranslatableContainer::make(
                    TextInput::make('title_block_second_forth')
                        ->label('Заголовок Четвертий')
                )->visible(fn ($get) => $get('state_two')),

                TranslatableContainer::make(
                    TextInput::make('title_block_second_fives')
                        ->label('Заголовок П’ятий')
                )->visible(fn ($get) => $get('state_two')),

                TranslatableContainer::make(
                    TextInput::make('title_block_second_six')
                        ->label('Заголовок Шостий')
                )->visible(fn ($get) => $get('state_two')),

                TranslatableContainer::make(
                    TextInput::make('title_block_second_sevens')
                        ->label('Заголовок Сьомий')
                )->visible(fn ($get) => $get('state_two')),

                TranslatableContainer::make(
                    TextInput::make('title_button_second')
                        ->label('Заголовок Кнопки'),
                )->visible(fn ($get) => $get('state_two')),

                TextInput::make('link_button_second')
                    ->label('Посилання Кнопки')
                    ->visible(fn ($get) => $get('state_two')),

                FileUpload::make('image_second_block_second')
                    ->label('Головне Фото')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE)
                    ->visible(fn ($get) => $get('state_two')),

                /*
                * third condition
                */
                TranslatableContainer::make(
                    TextInput::make('title_block_third_first')
                        ->label('Заголовок Перший'),
                )->visible(fn ($get) => $get('state_three')),

                TranslatableContainer::make(
                    TextInput::make('title_block_third_second')
                        ->label('Заголовок Другий')
                )->visible(fn ($get) => $get('state_three')),

                TranslatableContainer::make(
                    TextInput::make('title_block_third_three')
                        ->label('Заголовок Третій')
                )->visible(fn ($get) => $get('state_three')),

                TranslatableContainer::make(
                    TextInput::make('title_block_third_forth')
                        ->label('Заголовок Четвертий')
                )->visible(fn ($get) => $get('state_three')),

                TranslatableContainer::make(
                    TextInput::make('title_button_third')
                        ->label('Заголовок Кнопки'),
                )->visible(fn ($get) => $get('state_three')),

                TextInput::make('link_button_third')
                    ->label('Посилання Кнопки')
                    ->visible(fn ($get) => $get('state_three')),

                FileUpload::make('image_third_block_third')
                    ->label('Головне Фото')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE)
                    ->visible(fn ($get) => $get('state_three')),
            ]);
    }
}
