<?php

namespace Modules\Request\Filament\Tables;

use Carbon\Carbon;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Request\Enums\RequestStatus;
use Modules\Request\Models\Request;

class RequestTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(
                Request::query()
                    ->orderByDesc('created_at')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Ім\'я')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable()
                    ->getStateUsing(fn($record) => $record->phone)
                    ->alignCenter()
                    ->url(fn($record) => 'tel:' . $record->phone)
                    ->openUrlInNewTab(false),
                TextColumn::make('request_status')
                    ->label('Статус заявки')
                    ->badge()
                    ->formatStateUsing(fn($state) => RequestStatus::tryFrom($state)?->getLabel() ?? $state)
                    ->color(fn($state) => RequestStatus::tryFrom($state)?->getColor() ?? $state)
                    ->icon(fn($state) => RequestStatus::tryFrom($state)->getIcon() ?? $state)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Створено')->sortable()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->setTimezone('Europe/Kyiv')->format('Y-m-d H:i')),
            ])
            ->filters([
                //
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
