<?php

namespace Modules\Blocks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Blocks\Casts\BlockCast;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TemplateBlock extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'type',
        'status',
        'content',
    ];
    protected $casts = [
        'content' => BlockCast::class,
    ];
    public function getImageAttribute(): array|null|string
    {
        return $this->getMedia('image')->map(function ($mediaObject) {
            return $mediaObject->getUrl();
        })->toArray()[0] ?? null;
    }
}
