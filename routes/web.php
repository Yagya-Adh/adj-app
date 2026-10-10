<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCollectionController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Contacts
    Route::get('/contacts', [ContactController::class, 'index'])
        ->name('contact.index');

    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])
        ->name('contact.destroy');

    // Collections
    Route::resource('collections', AdminCollectionController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->names('admin.collections');

    // Blog
    Route::resource('blog', AdminBlogController::class)
        ->names('admin.blog');

    // Notifications
    Route::prefix('admin/notifications')
        ->name('admin.notifications.')
        ->controller(AdminNotificationController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');

            Route::post('/read-all', 'markAllAsRead')
                ->name('readAll');

            Route::post('/{id}/read', 'markAsRead')
                ->whereUuid('id')
                ->name('read');

            Route::delete('/{id}', 'destroy')
                ->whereUuid('id')
                ->name('destroy');
        });
});

// Authentication
require __DIR__.'/auth.php';

// Client routes
require __DIR__.'/client.php';