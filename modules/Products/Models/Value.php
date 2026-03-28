<?php

namespace Modules\Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Value extends Model
{
    use HasTranslations;
    use HasSlug;

    protected $table = 'values';

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'active',
        'characteristic_id',
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

    public function characteristic(): BelongsTo
    {
        return $this->belongsTo(Characteristic::class, 'characteristic_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_value', 'value_id', 'product_id');
    }
}
