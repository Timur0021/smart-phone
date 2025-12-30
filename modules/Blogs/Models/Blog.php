<?php

namespace Modules\Blogs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations;
    use HasSlug;

    protected $table = 'blogs';

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'sort_order',
        'category_id',
        'active',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    protected $attributes = [
        'view_count' => 0,
    ];

    public array $translatable = [
        'name',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
