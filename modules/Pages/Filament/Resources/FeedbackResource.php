<?php

namespace Modules\Pages\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Modules\Pages\Enums\FeedbackStatus;
use Modules\Pages\Filament\Resources\FeedbackResource\Pages;
use Modules\Pages\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\RatingTheme;

class FeedbackResource extends Resource
{
    use Translatable;

    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'fas-comment';

    protected static ?string $navigationGroup = 'Сторінки';

    protected static ?string $pluralModelLabel = 'Відгуки';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Відгуки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->label('Ім\'я')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Статус Відгуку')
                    ->options(FeedbackStatus::class),
                Forms\Components\Textarea::make('message')
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

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('first_name')
                    ->label('Ім\'я'),
                RatingColumn::make('mark')
                    ->label('Оцінка'),
                BadgeColumn::make('status')
                    ->label('Статус Відгуку')
                    ->badge(fn($state) => FeedbackStatus::tryFrom($state)?->getLabel() ?? 'Unknown')
                    ->color(fn($state) => FeedbackStatus::tryFrom($state)?->getColor() ?? 'gray')
                    ->icon(fn($state) => FeedbackStatus::tryFrom($state)?->getIcon() ?? 'fas-question-circle')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Створено')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->setTimezone('Europe/Kyiv')->format('Y-m-d H:i')),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Статус Відгуку')
                    ->options(function () {
                        return collect(FeedbackStatus::cases())->mapWithKeys(function ($status) {
                            return [$status->value => $status->getLabel()];
                        })->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
