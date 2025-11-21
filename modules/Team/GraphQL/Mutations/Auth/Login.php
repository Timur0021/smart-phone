<?php

namespace Modules\Team\GraphQL\Mutations\Auth;

use Modules\Team\Services\AuthService;

class Login
{
    /**
     *
     * @var AuthService
     */
    protected AuthService $authService;

    /**
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param null $_
     * @param array<string, mixed> $args
     * @throws
     */
    public function __invoke(null $_, array $args)
    {
        return $this->authService->login($args);
    }
}
