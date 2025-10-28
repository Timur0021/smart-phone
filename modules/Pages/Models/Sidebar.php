<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Products\Models\Category;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Sidebar extends Model
{
    use HasFactory;
    use NodeTrait;
    use HasTranslations;
    use HasSlug;

    protected $fillable = [
        'name',
        'order',
        'parent_id',
        'page_id',
        'is_catalog',
    ];

    public array $translatable = [
        'name',
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('uk')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'sidebar_to_page', 'sidebar_id','page_id')->orderBy('sort_order');
    }

    public function sidebars(): BelongsToMany
    {
        return $this->belongsToMany(Sidebar::class, 'sidebar_to_page')->withPivot('sort_order')
            ->using(SidebarPage::class)->orderByPivot('sort_order');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Sidebar::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Sidebar::class, 'parent_id')->orderBy('order');
    }

    public function getPagesDataAttribute(): array
    {
        $pages = $this->pages()
            ->where('status', true)
            ->orderBy('id')
            ->get();

        $categories = $this->is_catalog
            ? Category::query()
                ->where('active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(function ($category) {
                    return [
                        'title' => $category->title,
                        'slug'  => $category->slug,
                        'link'  => 'katalog/' . $category->slug,
                    ];
                })
            : collect();

        return [
            'pages' => $pages->isEmpty() ? null : $pages,
            'categories' => $categories->isEmpty() ? null : $categories,
        ];
    }

    public function getPageDataAttribute(): array
    {
        $page = $this->page()
            ->where('status', true)
            ->orderBy('id')
            ->first();

        $categories = $this->is_catalog
            ? Category::query()
                ->where('active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(function ($category) {
                    return [
                        'title' => $category->title,
                        'slug'  => $category->slug,
                        'link'  => 'katalog/' . $category->slug,
                    ];
                })
            : collect();

        return [
            'page' => $page ?: null,
            'categories' => $categories->isEmpty() ? null : $categories,
        ];
    }
}
