<?php

namespace Modules\Pages\Filament\Resources\PageResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\LocaleSwitcher;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;
use Modules\Pages\Enums\FeedbackStatus;
use Modules\Pages\Filament\Resources\FeedbackResource;

class FeedbackRelationManager extends RelationManager
{
    protected static string $relationship = 'feedbacks';

    protected static ?string $title = 'Відгуки';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->label('Ім\'я')
                    ->required()
                    ->formatStateUsing(function ($state) {
                        $locale = App::getLocale();
                        return $state[$locale] ?? '';
                    }),
                TextInput::make('phone')
                    ->label('Телефон')
                    ->type('tel')
                    ->mask('+380(99)9999999')
                    ->placeholder('+380(__)_______'),
                Forms\Components\Textarea::make('message')
                    ->label('Повідомлення')
                    ->required()
                    ->formatStateUsing(function ($state) {
                        $locale = App::getLocale();
                        return $state[$locale] ?? '';
                    }),
                Forms\Components\Select::make('status')
                    ->label('Статус Відгуку')
                    ->options(FeedbackStatus::class),
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Фото Галерея')
                    ->conversion('webp')
                    ->collection('image'),
                Select::make('category_id')
                    ->label('Категорія')
                    ->relationship('category', 'name', fn($query) => $query->where('is_active', true)->orderBy('name', 'ASC')),
                DateTimePicker::make('created_at')
                    ->label('Дата створення')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('feedback_page.sort_order')
            ->defaultSort('feedback_page.sort_order')
            ->recordTitleAttribute('first_name')
            ->columns([
                TextColumn::make('first_name')
                    ->label('Ім\'я'),
                TextColumn::make('phone')
                    ->label('Телефон')
                    ->getStateUsing(fn($record) => $record->phone)
                    ->alignCenter()
                    ->url(fn($record) => 'tel:' . $record->phone)
                    ->openUrlInNewTab(false),
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
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Не знайдено відгуків')
            ->emptyStateDescription('Натисніть "Прикріпити", щоб створити перший запис.');
    }
}
