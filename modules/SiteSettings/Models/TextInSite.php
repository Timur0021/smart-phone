<?php

namespace Modules\SiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class TextInSite extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;

    public array $translatable = [
        'text',
        'link',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'key',
        'is_new_window',
        'show_in_site',
        'sort_order',
    ];

    /**
     * @return array
     */
    public function getImageAttribute(): array|string|null
    {
        return $this->getMedia('image')->map(function ($mediaObject) {
            return $mediaObject->getUrl();
        })->toArray()[0] ?? null;
    }

    /**
     * @return array
     */
    public function getFileAttribute(): array|string|null
    {
        return $this->getMedia('files')->map(function ($mediaObject) {
            return $mediaObject->getUrl();
        })->toArray()[0] ?? null;
    }
}
