<?php

namespace Modules\Products\GraphQL\Queries;

use Collator;
use Illuminate\Support\Collection;
use Modules\Products\Models\Brand;

class Brands
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @return array
     */
    public function __invoke(null $_, array $args): array
    {
        $search = $args['search'] ?? null;

        $query = Brand::query()
            ->where('active', true);

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $brands = $query->orderBy('name')->get();

        $grouped = $brands->groupBy(function ($brand) {
            $name = trim($brand->name);
            $first = mb_substr($name, 0, 1);

            if (is_numeric($first)) {
                return $first;
            }

            return mb_strtoupper($first);
        });

        $keys = $grouped->keys()->all();

        usort($keys, function ($a, $b) {
            $isANumeric = is_numeric($a);
            $isBNumeric = is_numeric($b);

            if ($isANumeric && $isBNumeric) {
                return (int)$a <=> (int)$b;
            }

            if ($isANumeric) {
                return 1;
            }

            if ($isBNumeric) {
                return -1;
            }

            $collator = new Collator('uk_UA');

            return $collator->compare($a, $b);
        });

        $grouped = collect($keys)
            ->mapWithKeys(fn($key) => [$key => $grouped->get($key)]);

        $letters = $grouped->keys()->toArray();

        return [
            'letters' => $letters,
            'data' => $grouped->map(function (Collection $brands, $letter) {
                return [
                    'letter' => $letter,
                    'brands' => $brands->values(),
                ];
            })->values()->toArray(),
        ];
    }
}
