<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class PageCategory extends Model
{
    use HasFactory, NodeTrait, HasTranslations;
    use HasSlug;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'parent_id',
        'order',
        'meta_title',
        'meta_description',
    ];

    protected array $translatable = [
        'name',
        'meta_title',
        'meta_description'
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
    public function page(): hasMany
    {
        return $this->hasMany(Page::class, 'category_id');
    }
}
