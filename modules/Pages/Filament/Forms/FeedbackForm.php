<?php

namespace Modules\Pages\Filament\Forms;

use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Modules\Pages\Enums\FeedbackStatus;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\RatingTheme;

class FeedbackForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Головна інформація')
                    ->columns()
                    ->schema([
                        TextInput::make('first_name')
                            ->label('Ім\'я')
                            ->required(),
                        TextInput::make('phone')
                            ->label('Телефон')
                            ->type('tel')
                            ->mask('+380(99)9999999')
                            ->placeholder('+380(__)_______'),
                        TextInput::make('email')
                            ->label('Email')
                            ->type('email'),
                        Select::make('status')
                            ->label('Статус Відгуку')
                            ->options(FeedbackStatus::class),
                        Textarea::make('message')
                            ->label('Повідомлення')
                            ->columnSpanFull()
                            ->rows(7)
                            ->required(),
                        DateTimePicker::make('created_at')
                            ->label('Дата створення')
                            ->required()
                            ->native(false)
                            ->formatStateUsing(
                                fn ($state) => Carbon::parse($state)
                                    ->timezone('Europe/Kyiv')
                                    ->format('Y-m-d H:i:s')
                            ),
                        Rating::make('mark')
                            ->label('Оцінка')
                            ->theme(RatingTheme::HalfStars)
                            ->size('xl')
                            ->stars(5),
                    ]),
            ]);
    }
}
