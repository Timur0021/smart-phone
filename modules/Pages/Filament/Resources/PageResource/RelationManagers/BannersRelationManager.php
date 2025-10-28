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
use Modules\Pages\Filament\Resources\BannerResource;

class BannersRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'banners';

    /**
     * @param Model<Category> $ownerRecord
     * @param string $pageClass
     * @return bool
     */

    public function form(Form $form): Form
    {
        return BannerResource::form($form);
    }

    public function table(Table $table): Table
    {
        return BannerResource::table($table)
            ->reorderable('order')
            ->defaultSort('order')
            ->recordTitleAttribute('title')
            ->headerActions([
                LocaleSwitcher::make(),
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Додати слайдер'),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ]);
    }
}
