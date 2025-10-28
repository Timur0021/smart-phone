<?php

namespace Modules\Pages\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Feedback extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;

    protected $table = 'feedback';

    protected $fillable = [
        'first_name',
        'message',
        'status',
        'mark',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public array $translatable = [
        'first_name',
        'message',
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
        return $this->belongsToMany(Page::class, 'feedback_page')->withPivot('sort_order');
    }

    public function sliders(): BelongsToMany
    {
        return $this->belongsToMany(Slider::class, 'slider_feedback', 'feedback_id', 'slider_id');
    }
}
