<?php

namespace Modules\Pages\Filament\Resources\SliderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Table;
use Modules\Pages\Filament\Resources\FeedbackResource;

class FeedbackRelationManager extends RelationManager
{
    protected static string $relationship = 'feedbacks';
    protected static ?string $title = 'Відгуки';
    protected static ?string $label = 'Відгуки';
    protected static ?string $pluralLabel = 'Відгуки';

    public function form(Form $form): Form
    {
        return FeedbackResource::form($form);
    }

    public function table(Table $table): Table
    {
        return FeedbackResource::table($table)
            ->reorderable('slider_feedback.sort_order')
            ->defaultSort('slider_feedback.sort_order')
            ->recordTitleAttribute('first_name')
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->modalHeading('Прикріпити Відгук')
                    ->color('info')
                    ->icon('heroicon-o-link')
                    ->preloadRecordSelect()
                    ->label('Прикріпити'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
