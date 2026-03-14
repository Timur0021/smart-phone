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

class Feedback extends Model
{
    use HasTranslations;

    protected $table = 'feedback';

    protected $fillable = [
        'first_name',
        'phone',
        'email',
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

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'feedback_page')->withPivot('sort_order');
    }

    public function sliders(): BelongsToMany
    {
        return $this->belongsToMany(Slider::class, 'slider_feedback', 'feedback_id', 'slider_id');
    }
}
