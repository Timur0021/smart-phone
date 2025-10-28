<?php

namespace Modules\Blocks\Filament\Resources;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Blocks\Filament\Resources\BlockResource\Pages;
use Modules\Blocks\Filament\Resources\BlockResource\RelationManagers;
use Modules\Blocks\Filament\Resources\BlockResource\RelationManagers\SlidersRelationManager;
use Modules\Blocks\Filament\Resources\Templates\Image;
use Modules\Blocks\Filament\Resources\Templates\Title;
use Modules\Blocks\Models\Block;
use Modules\Feedbacks\Filament\Resources\FeedbackResource;
use Modules\Pages\Filament\Resources\SliderResource\RelationManagers\FeedbacksRelationManager;

class BlockResource extends Resource
{
    //    use Translatable;

    protected static ?string $model = Block::class;

    protected static ?int $navigationSort = 5;


    protected static ?string $navigationGroup = 'Блоки';

    protected static ?string $pluralModelLabel = 'Блоки';

    protected static ?string $modelLabel = 'Блок';

    protected static ?string $navigationIcon = 'fas-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->label('Зображення')
                            ->conversion('webp')
                            ->collection('image'),
//                        Forms\Components\Select::make('slider_id')
//                            ->label('Слайдер')
//                            ->relationship('slider', 'name', fn($query) => $query->where('status', true)),
                        Forms\Components\TextInput::make('name')
                            ->label('Назва')
                            ->hidden(fn($operation) => $operation === 'create')
                            ->required(),
                        Forms\Components\Select::make('template_block_id')
                            ->label('Шаблон')
                            ->relationship(
                                name: 'template',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn(Builder $query) => $query->where('status', true),

                            ),
                        Forms\Components\Builder::make('content')
                            ->label('Контент')
                            ->hidden(fn($operation) => $operation === 'create')
                            ->blocks(Block::getBlocks()),
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Статус')
                            ->schema([
                                Grid::make(1)
                                    ->schema([
                                        Toggle::make('status')
                                            ->label('Статус')
                                            ->onColor('success')
                                            ->offColor('danger')
                                            ->default(true),
                                    ])
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label('Зображення')
                    ->collection('image'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Назва'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип'),
                ToggleIconColumn::make('status')
                    ->label('Статус')
                    ->onIcon('heroicon-s-lock-open')
                    ->offIcon('heroicon-o-lock-closed'),
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
                ])
            ])
            ->paginated([50]);
    }

    public static function getRelations(): array
    {
        return [
            SlidersRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlocks::route('/'),
            'create' => Pages\CreateBlock::route('/create'),
            'edit' => Pages\EditBlock::route('/{record}/edit'),
        ];
    }
}
