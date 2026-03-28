<?php

namespace Modules\Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Characteristic extends Model
{
    use HasTranslations;
    use HasSlug;

    protected $table = 'characteristics';

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'active',
        'show_in_filter',
        'show_in_product',
    ];

    public array $translatable = [
        'name',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('uk')
            ->slugsShouldBeNoLongerThan(30)
            ->doNotGenerateSlugsOnUpdate();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_characteristics', 'characteristic_id', 'category_id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(Value::class, 'characteristic_id')
            ->where('active', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}
