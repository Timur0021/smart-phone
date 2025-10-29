<?php

namespace Modules\SiteSettings\GraphQL\Queries;

use Modules\Blog\Models\Article;
use Modules\Blog\Models\ArticleCategory;
use Modules\Pages\Enums\FeedbackStatus;
use Modules\Pages\Models\Feedback;
use Modules\Pages\Models\Footer;
use Modules\Pages\Models\Page;
use Modules\Pages\Models\Sidebar;
use Modules\Products\Models\Brand;
use Modules\Products\Models\Category;
use Modules\Products\Models\Product;
use Modules\SiteSettings\Models\Setting;
use Modules\SiteSettings\Models\TextInSite;
use Modules\SiteSettings\Models\Word;

class Sitemap
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $baseUrl = Setting::query()->firstOrCreate([
            'key' => 'frontend_url',
        ], [
            'name' => 'Посилання на фронтенд ',
            'value' => 'https://new-tea.seok.com.ua',
            'to_front' => false,
        ])->value;

        // --- Pages ---
        $pages = Page::query()
            ->where('status', true)
            ->get()
            ->flatMap(function ($page) use ($baseUrl) {
                if($page->slug == 'golovna'){
                    return [
                        $baseUrl . '/',
                        $baseUrl . '/ru/',
                    ];
                }
                if($page->slug == 'kategoriia'){
                    return [
                        $baseUrl . '/catalog/',
                        $baseUrl . '/ru/catalog/',
                    ];
                }

                return [
                    $baseUrl . '/' . $page->slug  . '/',
                    $baseUrl . '/ru/' . $page->slug  . '/',
                ];
            });

        // --- Articles ---
        $articles = Article::query()
            ->where('status', true)
            ->get()
            ->flatMap(function ($article) use ($baseUrl) {
                return [
                    $baseUrl . '/blog/' . $article->slug . '/',
                    $baseUrl . '/ru/blog/' . $article->slug . '/',
                ];
            });

        // --- Categories ---
        $categories = Category::query()
            ->where('active', true)
            ->with('children')
            ->get()
            ->flatMap(function ($category) use ($baseUrl) {
                $urls = [
                    $baseUrl . '/catalog/' . $category->slug . '/',
                    $baseUrl . '/ru/catalog/' . $category->slug . '/',
                ];

                foreach ($category->children as $child) {
                    $urls[] = $baseUrl . '/catalog/' . $category->slug . '/' . $child->slug . '/';
                    $urls[] = $baseUrl . '/ru/catalog/' . $category->slug . '/' . $child->slug . '/';
                }

                return $urls;
            });

        // --- Products ---
        $products = Product::query()
            ->where('active', true)
            ->get()
            ->flatMap(function ($product) use ($baseUrl) {
                // $product?->categories?->whereNull('parent_id')->first()?->slug .
                return [
                    $baseUrl . '/product/' . $product->slug . '/',
                    $baseUrl . '/ru/product/' . $product->slug . '/',
                ];
            });

        $brands = Brand::query()
            ->where('active', true)
            ->with('categories')
            ->get()
            ->flatMap(function ($brand) use ($baseUrl) {
                $categories = $brand->categories()->whereNull('parent_id')->get();
                $url = '';
                if($categories->count() == 1){
                    $url = 'catalog/' . $categories->first()?->slug . '/' . $brand->slug;
                }else {
                    $url = 'catalog/' . $brand->slug;
                }
                return [
                    $baseUrl . '/' . $url,
                    $baseUrl . '/ru/' . $url,
                ];
            });
        return [
            'pages' => $pages,
            'articles' => $articles,
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
        ];
    }
}
