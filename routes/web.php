<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCollectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');

    // Collections
    Route::resource('collections', AdminCollectionController::class)
        ->only(['index', 'create', 'store','edit', 'update', 'destroy'])
        ->names('admin.collections');
        
        Route::resource('blog', AdminBlogController::class)->names('admin.blog');
}); 

require __DIR__.'/auth.php';
require __DIR__.'/client.php';