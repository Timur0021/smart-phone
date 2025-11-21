<?php

namespace Modules\Team\Services;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthService
{
    /**
     *
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
     * @throws Throwable
     */
    public function register(array $args): array
    {
        DB::beginTransaction();

        try {
            if (empty($args['email']) || empty($args['password'])) {
                throw new Error('Емейл або пароль не введений');
            }

            $userExists = $this->userService->checkUser($args['email']);

            if ($userExists) {
                throw new Error('Користувач з таким емейлом вже існує');
            }

            $user = $this->userService->createUser($args);

            $user->assignRole('customer');
            $token = $user->createToken('token')->plainTextToken;

            DB::commit();

            return [
                'user' => $user,
                'token' => $token,
            ];
        } catch (Error $error) {
            DB::rollBack();
            throw new Error($error->getMessage());
        }
    }

    /**
     * @throws Throwable
     * @throws Error
     */
    public function login(array $args): ?array
    {
        DB::beginTransaction();

        try {
            $user = $this->userService->getUserByEmail($args['email']);

            if (!$user) {
                throw new Error('Користувача такого не існує зареєструйтесь будь ласка!');
            }

            if (!Hash::check($args['password'], $user->password)) {
                throw new Error('Невірний пароль');
            }

            if ($args['remember_me']) {
                $user->remember_me = true;
                $user->save();
            }

            $token = $user->createToken('token')->plainTextToken;

            DB::commit();

            return [
                'user' => $user,
                'token' => $token,
            ];
        } catch (Error $error) {
            DB::rollBack();
            throw new Error($error->getMessage());
        }
    }

    /**
     * @return array
     */
    public function logout(): array
    {
        $user = Auth::user();

        $user->tokens()->delete();

        return [
            'success' => true,
            'message' => 'Ви успішно вийшли з профіля!',
        ];
    }
}
