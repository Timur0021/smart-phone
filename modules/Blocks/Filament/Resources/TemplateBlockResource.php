<?php

namespace Modules\Blocks\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Modules\Blocks\Filament\Resources\TemplateBlockResource\Pages;
use Modules\Blocks\Filament\Resources\TemplateBlockResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Blocks\Filament\Resources\Templates\Image;
use Modules\Blocks\Filament\Resources\Templates\Title;
use Modules\Blocks\Models\Block;
use Modules\Blocks\Models\TemplateBlock;

class TemplateBlockResource extends Resource
{
    protected static ?string $model = TemplateBlock::class;

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Блоки';

    protected static ?string $pluralModelLabel = 'Шаблони блоків';

    protected static ?string $modelLabel = 'Шаблон блоку';

    protected static ?string $navigationIcon = 'fas-table-cells-large';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Назва')
                            ->required(),
                        Forms\Components\TextInput::make('type')
                            ->label('Тип')
                            ->required(),
                        Forms\Components\Toggle::make('status')
                            ->label('Статус'),
                        Forms\Components\Builder::make('content')
                            ->label('Контент')
                            ->blocks(Block::getBlocks())

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Назва'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTemplateBlocks::route('/'),
            'create' => Pages\CreateTemplateBlock::route('/create'),
            'edit' => Pages\EditTemplateBlock::route('/{record}/edit'),
        ];
    }
}
