<?php

namespace Modules\Blogs\GraphQL\Queries;

use GraphQL\Error\Error;
use Modules\Blogs\Models\Blog;
use Modules\Blogs\Models\BlogCategory;

class Blogs
{
    /**
     * @param array{}
     * $args
     * @throws Error
     */
    public function __invoke(null $_, array $args): array
    {
        try {
            $page = $args['page'] ?? 1;
            $limit = $args['limit'] ?? 10;
            $categorySlug = $args['category_slug'] ?? null;

            $q = Blog::query()
                ->where('active', true)
                ->orderByDesc('published_at');

            $categoryQuery = BlogCategory::query()
                ->where('active', true);


            if ($categorySlug) {
                $category = (clone $categoryQuery)
                    ->where('slug', $categorySlug)
                    ->first();

                if ($category) {
                    $q->where('category_id', $category->id);
                } else {
                    throw new Error("Категорія не знайдена");
                }
            }

            $data = $q->paginate($limit, ['*'], 'page', $page);
            $filters = (clone $categoryQuery)
                ->where('active', true)
                ->orderBy('sort')
                ->orderBy('id')
                ->get();

            return [
                'data' => $data->items(),
                'pagination' => [
                    'firstItem' => $data->firstItem(),
                    'lastItem' => $data->lastItem(),
                    'currentPage' => $data->currentPage(),
                    'lastPage' => $data->lastPage(),
                    'total' => $data->total(),
                ],
                'filters' => $filters,
            ];
        } catch (Error $error) {
            throw new Error($error->getMessage());
        }
    }
}
