<?php

namespace Modules\Request\Filament\Forms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Modules\Request\Enums\RequestStatus;

class RequestForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns()
                    ->schema([
                        TextInput::make('name')
                            ->label('Ім\'я')
                            ->required(),
                        TextInput::make('last_name')
                            ->label('Прізвище'),
                        TextInput::make('phone')
                            ->label('Телефон')
                            ->type('tel')
                            ->mask('+380(99)9999999')
                            ->placeholder('+380(__)_______')
                            ->required(),
                        Select::make('request_status')
                            ->label('Статус замовлення')
                            ->options(RequestStatus::toArray()),
                        Textarea::make('message')
                            ->label('Повідомлення')
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
