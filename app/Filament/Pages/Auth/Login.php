<?php

namespace App\Filament\Pages\Auth;

use App\Mail\TwoFactorCodeMail;
use App\Models\TwoFactorCode;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Modules\Team\Models\User;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Random\RandomException;

class Login extends BaseLogin
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    /**
     * @throws RandomException
     */
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        if (!Auth::validate(['email' => $data['email'], 'password' => $data['password']])) {
            $this->addError('email', 'Невірний логін або пароль');
            return null;
        }

        $user = User::query()
            ->where('email', $data['email'])
            ->first();

        if (!$user) {
            $this->addError('email', 'Користувача не знайдено');
            return null;
        }

        if (!$user->two_factor_enabled) {
            Auth::login($user);

            return app(
                LoginResponse::class
            );
        }

        $otp = random_int(100000, 999999);

        TwoFactorCode::query()
            ->updateOrCreate(
                [
                    'user_id' => $user->id
                ],
                [
                    'code' => Hash::make($otp),
                    'expires_at' => now()->addMinutes(10),
                ]
            );

        Mail::to($user->email)->queue(
            new TwoFactorCodeMail($otp)
        );

        session()->regenerate();

        session([
            '2fa_user' => $user->id,
            '2fa_login_time' => now(),
        ]);

        return new class implements LoginResponse {
            public function toResponse($request): Redirector|RedirectResponse
            {
                return redirect('/two-factor');
            }
        };
    }
}
