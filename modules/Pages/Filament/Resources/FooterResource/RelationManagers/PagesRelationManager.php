<?php

namespace Modules\Pages\Filament\Resources\FooterResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\LocaleSwitcher;
use Filament\Tables\Table;
use Modules\Pages\Filament\Resources\PageResource;

class PagesRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'pages';

    protected static ?string $title =  'Сторінки';

    public function form(Form $form): Form
    {
        return PageResource::form($form);
    }

    public function table(Table $table): Table
    {
        return PageResource::table($table)
            ->reorderable('order')
            ->defaultSort('order')
            ->recordTitleAttribute('title')
            ->headerActions([
                LocaleSwitcher::make(),
                AttachAction::make()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->emptyStateHeading('Не знайдено сторінок')
            ->emptyStateDescription('Натисніть "Прикріпити", щоб створити перший запис.');;
    }
}
