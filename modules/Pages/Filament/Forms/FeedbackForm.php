<?php

namespace Modules\Pages\Filament\Forms;

use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
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
                TextInput::make('first_name')
                    ->label('Ім\'я')
                    ->required(),
                Select::make('status')
                    ->label('Статус Відгуку')
                    ->options(FeedbackStatus::class),
                Textarea::make('message')
                    ->label('Повідомлення')
                    ->columnSpanFull()
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
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Фото')
                    ->columnSpanFull()
                    ->conversion('webp')
                    ->collection('image'),
            ]);
    }
}
