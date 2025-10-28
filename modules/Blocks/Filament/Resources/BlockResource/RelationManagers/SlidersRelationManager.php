<?php

namespace Modules\Blocks\Filament\Resources\BlockResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\LocaleSwitcher;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Modules\Pages\Filament\Resources\SliderResource;

class SlidersRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'sliders';
    protected static ?string $title = 'Слайдери';
    protected static ?string $label = 'Слайдери';
    protected static ?string $pluralModelLabel = 'Слайдери';

    public function form(Form $form): Form
    {
        return SliderResource::form($form);
    }

    public function table(Table $table): Table
    {
        return SliderResource::table($table)
            ->reorderable('block_sliders.sort_order')
            ->defaultSort('block_sliders.sort_order')
            ->recordTitleAttribute('name')
            ->headerActions([
                LocaleSwitcher::make(),
                AttachAction::make()
                    ->label('Прикріпити')
                    ->color('info')
                    ->icon('heroicon-o-link')
                    ->preloadRecordSelect(),
            ])
            ->filters([
                //
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
