<?php

use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('admin');
});
Route::get('/two-factor', [TwoFactorController::class, 'form'])->name('two-factor.verify');
Route::post('/two-factor', [TwoFactorController::class, 'verify']);
