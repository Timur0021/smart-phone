<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Faq extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;

    protected $fillable = [
        'question',
        'answer',
        'status',
    ];

    public array $translatable = [
        'question',
        'answer',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')->nonQueued();
    }

    public function getImageAttribute(): array|null|string
    {
        return $this->getMedia('image')->map(function (Media $mediaObject) {
            return $mediaObject->getUrl('webp');
        })->toArray()[0] ?? null;
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'faq_page');
    }
}
