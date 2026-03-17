<?php

namespace Modules\Team\GraphQL\Mutations\Auth;

use GraphQL\Error\Error;
use Modules\Team\Services\AuthService;
use Throwable;

class Login
{
    /**
     * @var AuthService
     */
    protected AuthService $authService;

    /**
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @return array|null
     * @throws Error
     * @throws Throwable
     */
    public function __invoke(null $_, array $args): ?array
    {
        return $this->authService->login($args);
    }
}
