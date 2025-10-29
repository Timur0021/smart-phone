<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Blocks\Models\Block;
use Modules\Pages\Enums\FeedbackStatus;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Page extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'content',
        'status',
        'meta_title',
        'meta_description',
        'seo_title',
        'seo_description',
        'image_alt',
        'image_title',
        'page_id',
    ];

    public array $translatable = [
        'title',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'seo_title',
        'seo_description',
        'image_alt',
        'image_title',
    ];

    protected $casts = [
        'status' => 'boolean',
        'benefits' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        $slugOptions = SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
            ->usingLanguage('en');
        return $slugOptions;
    }

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

    public function blocks(): BelongsToMany
    {
        return $this->belongsToMany(Block::class, 'page_block')->withPivot('sort_order')
            ->using(PageBlock::class)->orderByPivot('sort_order');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PageCategory::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'page_id');
    }

    public function footers(): BelongsToMany
    {
        return $this->belongsToMany(Footer::class, 'footer_to_page', 'page_id', 'footer_id')->orderBy('order');
    }

    public function sidebars(): BelongsToMany
    {
        return $this->belongsToMany(Sidebar::class, 'sidebar_to_page')->withPivot('sort_order')
            ->using(SidebarPage::class)->orderByPivot('sort_order');
    }

    public function faqs(): BelongsToMany
    {
        return $this->belongsToMany(Faq::class, 'faq_page')->withPivot('order')->orderByPivot('order');
    }

    public function feedbacks(): BelongsToMany
    {
        return $this->belongsToMany(Feedback::class, 'feedback_page')->withPivot('sort_order')->orderByPivot('sort_order');
    }

    public function sliders(): BelongsToMany
    {
        return $this->belongsToMany(Slider::class, 'page_slider');
    }

    public function getBreadcrumbsAttribute(): array
    {
        $locale = app()->getLocale();
        $breadcrumbs = [];
        $page = $this;
        $linkParts = [];

        while ($page) {
            $title = $page->getTranslation('title', $locale);
            array_unshift($linkParts, $page->slug);
            $link = '/' . implode('/', $linkParts);

            array_unshift($breadcrumbs, [
                'title' => $title,
                'link' => $link,
            ]);

            $page = $page->parent;
        }

        return $breadcrumbs;
    }
}
