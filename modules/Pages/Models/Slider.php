<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Modules\Blocks\Models\Block;
use Modules\Products\Models\Brand;
use Modules\Products\Models\Category;
use Modules\Products\Models\Product;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Slider extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'with_category',
    ];

    public array $translatable = ['name'];

    public function getSlugOptions(): SlugOptions
    {
        $slugOptions = SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('en')
            ->doNotGenerateSlugsOnUpdate();
        return $slugOptions;

    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_slider')
            ->withPivot('sort_order')
            ->orderBy('product_slider.sort_order');
    }

    public function feedbacks(): BelongsToMany
    {
        return $this->belongsToMany(Feedback::class,'slider_feedback', 'slider_id', 'feedback_id')
            ->withPivot('sort_order')
            ->orderBy('slider_feedback.sort_order');
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class,'page_slider');
    }

    public function blocks(): BelongsToMany
    {
        return $this->belongsToMany(Block::class, 'block_sliders', 'slider_id', 'block_id');
    }

    public function getProductDataAttribute(): array
    {
        $products = $this->products()
            ->where('active', true)
            ->orderBy('product_slider.sort_order')
            ->get();

        $categoryIds = $products->load('categories')
            ->flatMap(fn($product) => $product->categories->pluck('id'))
            ->unique();

        $categories = Category::query()
            ->where('active', true)
            ->whereNull('parent_id')
            ->whereIn('id', $categoryIds)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return [
            'categories' => $categories,
            'products' => $products,
        ];
    }
}
