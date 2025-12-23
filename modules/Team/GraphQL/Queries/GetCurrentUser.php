<?php

namespace Modules\Team\GraphQL\Queries;

use GraphQL\Error\Error;
use Illuminate\Contracts\Auth\Authenticatable;
use Modules\Team\Models\User;

class GetCurrentUser
{
    /**
     * @param array{}
     * $args
     * @throws Error
     */
    public function __invoke(null $_, array $args): Authenticatable|User|null
    {
        try {
            return auth()->user();
        } catch (Error $error) {
            throw new Error($error->getMessage());
        }
    }
}
