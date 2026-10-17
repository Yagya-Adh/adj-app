<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ApiAuthenticateSessionController;

Route::post('/login', [
    ApiAuthenticateSessionController::class,
    'store',
])->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [
        ApiAuthenticateSessionController::class,
        'destroy',
    ]);
});