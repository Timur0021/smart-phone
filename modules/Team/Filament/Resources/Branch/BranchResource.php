<?php

namespace Modules\Team\Filament\Resources\Branch;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Modules\Team\Enums\LocalesEnum;
use Modules\Team\Filament\Resources\Branch\BranchResource\Pages;
use Modules\Team\Filament\Resources\Branch\BranchResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Team\Models\Branch;
use Modules\Team\Models\User;
use Rawilk\FilamentPasswordInput\Password;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'fas-earth-europe';

    protected static ?string $slug = 'branches';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('uk.navigationGroup_user');
    }

    public static function getNavigationLabel(): string
    {
        return __('uk.navigationLabel_branch');
    }

    public static function getModelLabel(): string
    {
        return __('uk.modelLabel_branch');
    }

    public static function getPluralModelLabel(): string
    {
        return __('uk.pluralModelLabel_branch');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(trans('branch.main_section'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('uk.name'))
                            ->required(),
                        Select::make('locale')
                            ->label(__('uk.locale'))
                            ->options(LocalesEnum::class)
                            ->preload(),
                    ])->columnSpan(2)->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('uk.id'))
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('uk.name'))
                    ->searchable()
                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
