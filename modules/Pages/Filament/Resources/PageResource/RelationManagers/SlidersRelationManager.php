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
use Modules\Pages\Filament\Resources\SliderResource;

class SlidersRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'sliders';
    protected static ?string $title = 'Слайдери';


    public function form(Form $form): Form
    {
        return SliderResource::form($form);
    }

    public function table(Table $table): Table
    {
        return SliderResource::table($table)
            ->reorderable()
            ->defaultSort('')
            ->recordTitleAttribute('name')
            ->headerActions([
                LocaleSwitcher::make(),
                AttachAction::make()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->emptyStateHeading('Не знайдено слайдерів')
            ->emptyStateDescription('Натисніть "Прикріпити", щоб створити перший запис.')
            ->defaultSort('sliders.id', 'desc');
    }
}
