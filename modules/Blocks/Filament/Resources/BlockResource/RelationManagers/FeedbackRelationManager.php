<?php

namespace Modules\Blocks\Filament\Resources\BlockResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\LocaleSwitcher;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Blocks\Filament\Resources\BlockResource;
use Modules\Feedbacks\Filament\Resources\FeedbackResource;
use Modules\Feedbacks\Models\Feedback;


class FeedbackRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'feedbacks';

    /**
     * @param Model<Feedback> $ownerRecord
     * @param string $pageClass
     * @return bool
     */

    public function form(Form $form): Form
    {
        return FeedbackResource::form($form);
    }

    public function table(Table $table): Table
    {
        return FeedbackResource::table($table)
            ->reorderable('block_feedback.order')
            ->defaultSort('block_feedback.order')
            ->recordTitleAttribute('name')
            ->headerActions([
                LocaleSwitcher::make(),
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Attach Feedback'),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ]);
    }
}
