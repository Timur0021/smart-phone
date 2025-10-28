<?php

namespace Modules\Pages\GraphQL\Queries;

use Modules\Pages\Models\Page;
use Modules\Products\Models\Brand;
use Modules\Products\Models\Product;
use Modules\Products\Models\Category;
use Modules\Blog\Models\Article;

class GetSitemap
{
    public function __invoke(null $_, array $args)
    {
        $baseUrl = config('app.frontend_url');
        $locales = config('app.locales');
        $urls = [];

        $pages = Page::query()->where('status', true)->get();
        foreach ($pages as $page) {
            foreach ($locales as $lang) {
                $urls[] = $baseUrl . ($lang === 'uk' ? '' : "/$lang") . "/{$page->slug}";
            }
        }

        $categories = Category::query()->where('active', true)->get();
        foreach ($categories as $cat) {
            foreach ($locales as $lang) {
                $urls[] = $baseUrl . ($lang === 'uk' ? '' : "/$lang") . "/katalog/{$cat->slug}";
            }
        }

        $products = Product::query()->where('active', true)->get();
        foreach ($products as $product) {
            foreach ($locales as $lang) {
                $urls[] = $baseUrl . ($lang === 'uk' ? '' : "/$lang") . "/product/{$product->slug}";
            }
        }

        return $urls;
    }
}
