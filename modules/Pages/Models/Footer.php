<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Footer extends Model
{
    use HasFactory;
    use NodeTrait;
    use HasTranslations;
    use HasSlug;

    public array $translatable = [
        'name',
    ];
    protected $fillable = [
        'name',
        'order',
        'parent_id',
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('uk')
            ->doNotGenerateSlugsOnUpdate();
    }
    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'footer_to_page', 'footer_id','page_id')->orderBy('order');
    }
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Footer::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Footer::class, 'parent_id')->orderBy('order');
    }
}
