<?php

namespace Modules\Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasSlug;
    use ModelTree;
    use HasTranslations;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'sort_order',
        'active',
        'will_be_soon',
    ];

    protected array $translatable = [
        'name',
    ];

    public function getOrderColumn(): string
    {
        return 'sort_order';
    }

    public function getParentColumn(): string
    {
        return 'parent_id';
    }

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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function getImageAttribute(): array|null|string
    {
        return $this->getMedia('image')->map(function ($mediaObject) {
            return $mediaObject->getUrl('webp');
        })->toArray()[0] ?? null;
    }
}
