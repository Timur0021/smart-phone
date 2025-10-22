<?php

namespace Modules\Team\Filament\Resources\Admin;

use App\Filament\Resources\Admin\AdminResource\Pages;
use App\Filament\Resources\Admin\AdminResource\RelationManagers;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Modules\Team\Filament\Resources\Admin\AdminResource\Pages\CreateAdmin;
use Modules\Team\Filament\Resources\Admin\AdminResource\Pages\EditAdmin;
use Modules\Team\Filament\Resources\Admin\AdminResource\Pages\ListAdmins;
use Modules\Team\Models\User;
use Rawilk\FilamentPasswordInput\Password;

class AdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'fas-user-tie';

    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'users';

    public static function getNavigationGroup(): ?string
    {
        return __('uk.navigationGroup_user');
    }

    public static function getNavigationLabel(): string
    {
        return __('uk.navigationLabel_admin');
    }

    public static function getModelLabel(): string
    {
        return __('uk.modelLabel_admin');
    }

    public static function getPluralModelLabel(): string
    {
        return __('uk.pluralModelLabel_admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('uk.main_section'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('uk.name'))
                            ->required(),
                        TextInput::make('email')
                            ->label(__('uk.email'))
                            ->type('email')
                            ->unique(
                                table: User::class,
                                column: 'email',
                                ignoreRecord: true,
                            )
                            ->validationMessages([
                                'unique' => 'Користувач з таким емейлом вже існує.',
                            ])
                            ->required(),
                        Password::make('password')
                            ->label(__('uk.password'))
                            ->required()
                            ->rules('min:3'),
                        Select::make('roles')
                            ->label(__('uk.role'))
                            ->preload()
                            ->relationship('roles', 'name'),
                        Select::make('branch')
                            ->label(__('uk.branch'))
                            ->preload()
                            ->relationship('branch', 'name')
                    ])->columnSpan(2)->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()->whereHas('roles', function ($query) {
                    $query->whereIn('name', ['super_admin', 'admin']);
                })
            )
            ->columns([
                TextColumn::make('id')
                    ->label(__('uk.id'))
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('uk.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('uk.email'))
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label(__('uk.role')),
                TextColumn::make('branch.name')
                    ->label(__('uk.branch')),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->preload()
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
            'index' => ListAdmins::route('/'),
            'create' => CreateAdmin::route('/create'),
            'edit' => EditAdmin::route('/{record}/edit'),
        ];
    }
}
