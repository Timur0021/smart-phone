<?php

namespace Modules\Pages\Filament\Resources;

use App\Filament\Resources\CategoryResource\RelationManagers\BadgesRelationManager;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Categories\Models\Category;
use Modules\Pages\Enums\ColorEnum;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\BannersRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\BlocksRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\FaqsRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\FeedbackRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\SlidersRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\TeachersRelationManager;
use Modules\Pages\Models\Page;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationGroup = 'Сторінки';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Сторінки';

    protected static ?string $modelLabel = 'Сторінки';

    protected static ?string $navigationIcon = 'fas-file-lines';

    public static function getPluralLabel(): string
    {
        return 'Сторінки';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Фото'))
                    ->columns()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Фото')
                            ->columnSpanFull()
                            ->collection('image')
                            ->conversion('webp'),
                        Forms\Components\TextInput::make('image_alt')
                            ->label('Фото Альт')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('image_title')
                            ->label('Фото Назва')
                            ->maxLength(255),
                    ]),
                Section::make(__('Головна'))
                    ->columns()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Назва')
                            ->maxLength(255)
                            ->hintAction(
                                Action::make('copyTitleToMetaTitle')
                                    ->icon('heroicon-m-clipboard')
                                    ->action(function (Set $set, $state) {
                                        $set('meta_title', $state);
                                        $set('meta_description', $state);
                                    })
                            )
                            ->required(),
                        TextInput::make('slug')
                            ->label('Слаг')
                            ->helperText(function (string $operation) {
                                if ($operation === 'create') {
                                    return 'Will be generated automatically if empty';
                                }
                            })
                            ->maxLength(255),
                        Select::make('color')
                            ->label('Колір')
                            ->options(ColorEnum::class),
                        Forms\Components\Textarea::make('description')
                            ->label('Опис')
                            ->columnSpanFull(),
                        TinyEditor::make('content')
                            ->label('Контент')
                            ->profile('default')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('status')
                            ->label('Активний')
                            ->onColor('success')
                            ->offColor('danger')->default(true),
                    ]),
//                Section::make(__('СЕО'))
//                    ->columns()
//                    ->schema([
//                        TextInput::make('seo_title')
//                            ->label('СЕО Назва'),
//                        TinyEditor::make('seo_description')
//                            ->label('СЕО Опис')
//                            ->profile('default')
//                            ->columnSpanFull(),
//                    ]),
                Section::make(__('Мета'))
                    ->columns()
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Мета Назва'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Мета Опис'),
                    ]),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Фото')
                    ->collection('image')
                    ->conversion('webp'),
                TextColumn::make('title')
                    ->label('Назва')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereRaw('LOWER(title) LIKE ?', ['%' . mb_strtolower($search) . '%']);
                    }),
                BadgeColumn::make('color')
                    ->label('Колір')
                    ->formatStateUsing(fn($state) => ColorEnum::tryFrom($state)?->getLabel() ?? $state)
                    ->color(fn($state) => match (ColorEnum::tryFrom($state)) {
                        ColorEnum::BLUE => 'info',
                        ColorEnum::GREEN => 'success',
                        ColorEnum::ORANGE => 'orange',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Статус'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

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
            BlocksRelationManager::make(),
            FaqsRelationManager::make(),
            FeedbackRelationManager::make(),
            SlidersRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => PageResource\Pages\ListPages::route('/'),
            'create' => PageResource\Pages\CreatePage::route('/create'),
            'edit' => PageResource\Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
