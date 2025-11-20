<?php

namespace Modules\Team\GraphQL\Mutations\Auth;

use GraphQL\Error\Error;

class Register
{
    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @throws
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
