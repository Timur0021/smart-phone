<?php

namespace Modules\Notification\Filament\Forms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class SubscribeForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Головна інформація')
                    ->schema([
                        TextInput::make('email')
                            ->required(),
                    ]),
            ]);
    }
}
