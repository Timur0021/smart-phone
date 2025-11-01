<?php

namespace Modules\Pages\Filament\Forms;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class FooterForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Назва')
                    ->columnSpanFull(),
            ]);
    }
}
