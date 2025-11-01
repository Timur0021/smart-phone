<?php

namespace Modules\Pages\Filament\Tables;

use Carbon\Carbon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Modules\Pages\Enums\FeedbackStatus;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;

class FeedbackTable
{
    public static function configure(Table $table): Table
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
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
