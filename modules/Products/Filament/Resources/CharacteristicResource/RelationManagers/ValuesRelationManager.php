<?php

namespace Modules\Products\Filament\Resources\CharacteristicResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Products\Filament\Forms\ValueForm;
use Modules\Products\Filament\Tables\ValueTable;

class ValuesRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'values';

    protected static ?string $title = 'Значення';
    protected static ?string $modelLabel = 'Значення';
    protected static ?string $pluralModelLabel = 'Значення';

    public function form(Form $form): Form
    {
        return ValueForm::configure($form);
    }

    public function table(Table $table): Table
    {
        return ValueTable::configure($table)
            ->recordTitleAttribute('name')
            ->headerActions([
                Tables\Actions\LocaleSwitcher::make(),
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
