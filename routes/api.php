<?php

use App\Http\Controllers\TemporaryFileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/temporary-files', [TemporaryFileController::class, 'store']);
Route::delete('/temporary-files', [TemporaryFileController::class, 'delete']);
