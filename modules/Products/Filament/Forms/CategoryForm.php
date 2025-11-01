<?php

namespace Modules\Products\Filament\Forms;

use App\Forms\Components\CategoryCharacteristic;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Products\Models\Category;

class CategoryForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('navigation')
                    ->tabs([
                        Tab::make('Головна інформація')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Назва')
                                    ->live(true)
                                    ->afterStateUpdated(function (Set $set, string $operation, ?string $state) {
                                        if (!empty($state) && $operation === 'create') {
                                            $set('slug', Str::slug($state));
                                        }
                                    })
                                    ->required(),
                                TextInput::make('slug')
                                    ->label('Слаг')
                                    ->hidden(function (string $operation) {
                                        if ($operation === 'create') {
                                            return true;
                                        }
                                    })
                                    ->required(),
                                TextInput::make('product_count')
                                    ->label('Кількість товарів')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(false),
                                Select::make('parent_id')
                                    ->label('Батьківська категорія')
                                    ->searchable()
                                    ->native(false)
                                    ->options(
                                        fn(?Model $record) => Category::query()
                                            ->whereNot('id', $record?->id)
                                            ->where('parent_id', null)
                                            ->get()
                                            ->mapWithKeys(function ($category) {
                                                $name = $category->getTranslation('name', app()->getLocale()) ?? $category->name;
                                                return [$category->id => $name];
                                            })
                                            ->toArray(),
                                    ),
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->label('Фото')
                                    ->columnSpanFull()
                                    ->collection('image'),
                            ])->columns(2)->columnSpan(1),
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Статус')
                            ->columns(2)
                            ->schema([
                                Toggle::make('active')
                                    ->label('Активний')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true),
                                Toggle::make('will_be_soon')
                                    ->label('Скоро у продажу!')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }
}
