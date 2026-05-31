<?php

namespace Modules\Products\GraphQL\Queries;

use GraphQL\Error\Error;
use Modules\Products\Models\Product as ProductModel;

class Product
{
    /**
     * @param array{}
     * $args
     * @throws Error
     */
    public function __invoke(null $_, array $args): ?ProductModel
    {
        try {
            $product = ProductModel::query()
                ->where('active', true)
                ->where('slug', $args['slug'])
                ->first();

            if (!$product) {
                throw new Error("Product not found");
            }

            $product?->increment('views');

            return $product;
        } catch (Error $error) {
            throw new Error($error->getMessage());
        }
    }
}
