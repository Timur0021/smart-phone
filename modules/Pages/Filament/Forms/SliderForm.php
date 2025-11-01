<?php

namespace Modules\Pages\Filament\Forms;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class SliderForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Назва')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('slug')
                    ->label('Слаг')
                    ->helperText(function (string $operation) {
                        if ($operation === 'create') {
                            return 'Will be generated automatically if empty';
                        }
                    })
                    ->columnSpanFull()
                    ->maxLength(255),
                Toggle::make('status')
                    ->label('Статус')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
                Toggle::make('with_category')
                    ->label('З категоріями')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
            ]);
    }
}
