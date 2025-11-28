<?php

namespace Modules\Products\GraphQL\Queries;

use GraphQL\Error\Error;
use Modules\Products\Models\Brand as Model;

class Brand
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @return Model
     * @throws Error
     */
    public function __invoke(null $_, array $args)
    {
        try {
            $brand = Model::query()
                ->where('slug', $args['slug'])
                ->first();

            if (!$brand) {
                throw new Error("Бренда не знайдено");
            }

            return $brand;
        } catch (Error $error) {
            throw new Error($error->getMessage());
        }
    }
}
