<?php

namespace Modules\Pages\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Pages\Filament\Resources\SliderResource\RelationManagers\FeedbackRelationManager;
use Modules\Pages\Filament\Resources\SliderResource\RelationManagers\ProductsRelationManager;
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
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Назва')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('slug')
                    ->label('Слаг')
                    ->helperText(function (string $operation) {
                        if ($operation === 'create') {
                            return 'Will be generated automatically if empty';
                        }
                    })
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->label('Статус')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
                Forms\Components\Toggle::make('with_category')
                    ->label('З категоріями')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Назва'),
                Tables\Columns\ToggleColumn::make('status')->label('Статус'),
                Tables\Columns\ToggleColumn::make('with_category')->label('З категоріями'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
