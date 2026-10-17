<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\CollectionApiController;
use App\Http\Controllers\Api\ContactApiController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\ShopApiController;
use App\Http\Controllers\Api\FaqApiController;

use App\Http\Controllers\Api\Admin\AuthApiController;
use App\Http\Controllers\Api\Admin\DashboardApiController;
use App\Http\Controllers\Api\Admin\BlogAdminApiController;
use App\Http\Controllers\Api\Admin\CollectionAdminApiController;
use App\Http\Controllers\Api\Admin\PageAdminApiController;

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', [HomeApiController::class, 'index']);

Route::get('/collections', [CollectionApiController::class, 'index']);

Route::get('/category/{slug}', [CollectionApiController::class, 'show']);

Route::get('/category/{slug}/{id}', [CollectionApiController::class, 'onlyRead']);

Route::post('/contact', [ContactApiController::class, 'store'])
    ->middleware('throttle:10,1');

Route::get('/blogs', [BlogApiController::class, 'index']);

Route::get('/blogs/{id}', [BlogApiController::class, 'show'])
    ->whereNumber('id');

Route::get('/shop', [ShopApiController::class, 'index']);

Route::get('/faq', [FaqApiController::class, 'index']);


/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthApiController::class, 'login'])
        ->middleware('throttle:5,1');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthApiController::class, 'logout']);

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::middleware('can:manage-content')->group(function () {
            Route::get('/dashboard', [DashboardApiController::class, 'index']);

            /*
            |--------------------------------------------------------------------------
            | Blog Management
            |--------------------------------------------------------------------------
            */

            Route::apiResource('blogs', BlogAdminApiController::class);

            /*
            |--------------------------------------------------------------------------
            | Collection Management
            |--------------------------------------------------------------------------
            */

            Route::apiResource('collections', CollectionAdminApiController::class);

            /*
            |--------------------------------------------------------------------------
            | Home and About Page Management
            |--------------------------------------------------------------------------
            */

            Route::get('/pages/{page}', [PageAdminApiController::class, 'show'])
                ->whereIn('page', ['home', 'about']);

            Route::put('/pages/{page}', [PageAdminApiController::class, 'update'])
                ->whereIn('page', ['home', 'about']);
        });
    });
});

require __DIR__ . '/api_auth.php';