<?php

namespace App\Http\Controllers;

use App\Models\TwoFactorCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TwoFactorController
    extends Controller
{

    public function form(): View
    {
        return view(
            'auth.twofactor'
        );
    }


    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code'=>'required'
        ]);

        $userId = session('2fa_user');

        $record = TwoFactorCode::query()
            ->where('user_id', $userId)
            ->first();

        if(!$record || Carbon::now()->gt($record->expires_at) || !Hash::check($request->code, $record->code)) {
            return back()
                ->withErrors([
                    'code'=>'Код невірний'
                ]);
        }

        Auth::loginUsingId($userId);

        $record->delete();

        session()->forget('2fa_user');

        return redirect('/admin');
    }
}
