<?php

namespace Modules\SiteSettings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;
//    use HasTranslations;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'key',
        'value',
        'is_new_window',
        'show_in_site',
        'sort_order',
    ];
    protected $casts = [
        'updated_at' => 'datetime',
    ];


//    public array $translatable = [
//        'value',
//    ];

}
