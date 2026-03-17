<?php

namespace Modules\Team\GraphQL\Mutations\Auth;

use Modules\Team\Services\AuthService;
use Throwable;

class RegisterGoogle
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
     * @param array{}
     * $args
     * @throws Throwable
     */
    public function __invoke(null $_, array $args): array
    {
        return $this->authService->registerGoogle($args);
    }
}
