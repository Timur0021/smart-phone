<?php

namespace Modules\Products\Filament\Resources\CategoryResource\Widgets;

use Filament\Forms\Components\TextInput;
use Modules\Products\Models\Category;
use SolutionForest\FilamentTree\Widgets\Tree as TreeWidget;
use Illuminate\Database\Eloquent\Model;

class CategoryTreeWidget extends TreeWidget
{
    protected static string $model = Category::class;

    protected static int $maxDepth = 3;

    protected static ?string $parentColumn = null;

    protected ?string $treeTitle = 'Категорії';

    protected bool $enableTreeTitle = true;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name'),
        ];
    }

    public function getViewFormSchema(): array
    {
        return [
            //
        ];
    }
}
