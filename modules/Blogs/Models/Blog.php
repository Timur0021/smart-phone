<?php

namespace Modules\Blogs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Blog extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->nonQueued();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function getImageAttribute(): array|null|string
    {
        return $this->getMedia('image')->map(function ($mediaObject) {
            return $mediaObject->getUrl('webp');
        })->toArray()[0] ?? null;
    }
}
