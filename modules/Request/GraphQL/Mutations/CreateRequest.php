<?php

namespace Modules\Request\GraphQL\Mutations;

use GraphQL\Error\Error;

class CreateRequest
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @throws Error
     */
    public function __invoke(null $_, array $args)
    {
        try {
            dd(212);
        } catch (Error $error) {
            throw new Error($error->getMessage());
        }
    }
}
