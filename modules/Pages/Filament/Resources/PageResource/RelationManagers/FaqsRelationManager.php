<?php

namespace Modules\Pages\Filament\Resources\PageResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\LocaleSwitcher;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\Models\Category;
use Modules\Pages\Filament\Resources\FaqResource;

class FaqsRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'faqs';

    protected static ?string $title = 'Часті питання';

    /**
     * @param Model<Category> $ownerRecord
     * @param string $pageClass
     * @return bool
     */

    public function form(Form $form): Form
    {
        return FaqResource::form($form);
    }

    public function table(Table $table): Table
    {
        return FaqResource::table($table)
            ->reorderable('faq_page.order')
            ->defaultSort('faq_page.order')
            ->recordTitleAttribute('question')
            ->headerActions([
                LocaleSwitcher::make(),
                AttachAction::make()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->emptyStateHeading('Не знайдено питань-відповідей')
            ->emptyStateDescription('Натисніть "Прикріпити", щоб створити перший запис.');;
    }
}
