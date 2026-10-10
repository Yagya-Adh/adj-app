<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCollectionController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/admin/notifications', [AdminNotificationController::class, 'index'])
        ->name('admin.notifications.index');

    Route::post('/admin/notifications/{id}/read', [AdminNotificationController::class, 'markAsRead'])
        ->whereUuid('id')
        ->name('admin.notifications.read');

    Route::post('/admin/notifications/read-all', [AdminNotificationController::class, 'markAllAsRead'])
        ->name('admin.notifications.readAll');
});

require __DIR__.'/auth.php';
require __DIR__.'/client.php';