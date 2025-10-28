<?php

namespace Modules\Pages\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Modules\Pages\Models\Page;

class PagesService
{
    /**
     * @param  int  $id
     */
    public function find(string $slug, bool $withTrashed = false): mixed
    {
        if ($withTrashed) {
            return Page::withTrashed()->where('slug', $slug)->first();
        }

        return Page::query()->where('slug', $slug)->first();
    }

    public function findAll(?array $filters, int $page = 1, int $first = 10, string $sort = 'id', string $order = 'asc'): LengthAwarePaginator
    {
        $pages = Page::query();

        if (! empty($filters['search'])) {
            $search = Str::lower($filters['search']);

            $pages->whereRaw('LOWER(name) LIKE ? OR LOWER(slug) LIKE ?', [$search, $search]);
        }

        return $pages->orderBy('order')
            ->paginate($first ?? 10, ['*'], 'page', $page ?? 1);
    }
}
