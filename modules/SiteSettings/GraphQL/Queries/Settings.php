<?php

namespace Modules\SiteSettings\GraphQL\Queries;

use Modules\Pages\Enums\FeedbackStatus;
use Modules\Pages\Models\Feedback;
use Modules\Pages\Models\Footer;
use Modules\Pages\Models\Sidebar;
use Modules\Products\Models\Category;
use Modules\SiteSettings\Models\Setting;
use Modules\SiteSettings\Models\TextInSite;
use Modules\SiteSettings\Models\Word;

class Settings
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $text_in_site = TextInSite::query()
            ->where('show_in_site', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $settings = Setting::query()
            ->where('show_in_site', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $footers = Footer::query()
            ->with([
                'pages' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->get();

        $sidebars = Sidebar::query()
            ->with([
                'pages' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->get();

        $product_categories = Category::query()
            ->where('active', true)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $words = Word::query()
            ->where('active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        return [
            'text_in_site' => $text_in_site,
            'product_categories' => $product_categories,
            'settings' => $settings,
            'footers' => $footers,
            'sidebars' => $sidebars,
            'words' => $words,
        ];
    }
}
