<?php

namespace Modules\Blogs\GraphQL\Queries;

use GraphQL\Error\Error;
use Modules\Blogs\Models\Blog as BlogModel;

class Blog
{
    /**
     * @param array{}
     * $args
     * @throws Error
     */
    public function __invoke(null $_, array $args): BlogModel
    {
        try {
            $blog = BlogModel::query()
                ->where('active', true)
                ->where('slug', $args['slug'])
                ->first();

            if (!$blog) {
                throw new Error("Блог не знайдено");
            }

            return $blog;
        } catch (Error $error) {
            throw new Error($error->getMessage());
        }
    }
}
