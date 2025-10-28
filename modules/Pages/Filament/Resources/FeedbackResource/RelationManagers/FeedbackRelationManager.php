<?php

namespace Modules\Pages\Filament\Resources\FeedbackResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Pages\Enums\FeedbackStatus;
use Modules\Pages\Filament\Resources\FeedbackResource;

class FeedbackRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'feedbacks';

    protected static ?string $title = 'Відгуки';

    public function form(Form $form): Form
    {
        return FeedbackResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('first_name')
            ->defaultPaginationPageOption(25)
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
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
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
