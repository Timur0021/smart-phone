<?php

namespace Modules\Pages\Filament\Forms;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class SidebarForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                TextInput::make('name')
                    ->label('Назва'),
                Select::make('page_id')
                    ->label('Головна сторінка')
                    ->relationship('page', 'title', fn($query) => $query->where('status', true)->orderBy('title', 'ASC'))
                    ->preload(),
                Toggle::make('is_catalog')
                    ->label('Каталог')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
            ]);
    }
}
