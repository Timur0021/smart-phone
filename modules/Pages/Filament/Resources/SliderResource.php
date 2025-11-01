<?php

namespace Modules\Pages\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Pages\Filament\Forms\SliderForm;
use Modules\Pages\Filament\Resources\SliderResource\RelationManagers\FeedbackRelationManager;
use Modules\Pages\Filament\Resources\SliderResource\RelationManagers\ProductsRelationManager;
use Modules\Pages\Filament\Tables\SliderTable;
use Modules\Pages\Models\Slider;

class SliderResource extends Resource
{
    use Translatable;

    protected static ?string $model = Slider::class;

    protected static ?string $navigationGroup = 'Сторінки';

    protected static ?string $navigationIcon = 'fas-sliders';


    protected static ?string $pluralModelLabel = 'Слайдери';

    protected static ?int $navigationSort = 13;

    protected static ?string $navigationLabel = 'Слайдери';

    protected static ?string $modelLabel = 'Слайдери';

    public static function form(Form $form): Form
    {
        return SliderForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return SliderTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::make(),
            FeedbackRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => SliderResource\Pages\ListSliders::route('/'),
            'create' => SliderResource\Pages\CreateSlider::route('/create'),
            'edit' => SliderResource\Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
