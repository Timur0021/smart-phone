<?php

namespace Modules\Team\GraphQL\Mutations\Settings;

use GraphQL\Error\Error;
use Modules\Team\Models\User;
use Modules\Team\Services\UserService;
use Exception;

class UpdatePersonalData
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param array{}
     * $args
     * @throws Error
     * @throws Exception
     */
    public function __invoke(null $_, array $args): User
    {
        try {
            /** @var User $user */
            $user = auth()->user();

            return $this->userService->updateUser($user, $args);
        } catch (Error $error) {
            throw new Error($error->getMessage());
        }
    }
}
