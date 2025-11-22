<?php

namespace Modules\Team\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Team\Models\User;

class UserService
{
    public function createUser(array $data): User|Authenticatable
    {
        return User::query()
            ->create([
                'name' => $data['name'] ?? '',
                'last_name' => $data['last_name'] ?? '',
                'email' => $data['email'] ?? '',
                'phone' => $data['phone'] ?? '',
                'remember_me' => false,
                'i_agree' => $data['i_agree'] ?? false,
                'email_verified_at' => Carbon::now(),
                'password' => isset($data['password']) ? Hash::make($data['password']) : null,
                'remember_token' => $data['remember_token'] ?? Str::random(10),
            ]);
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }

    public function checkUser(string $email): bool
    {
        return User::query()
            ->where('email', $email)
            ->exists();
    }
}
