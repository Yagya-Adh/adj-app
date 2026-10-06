<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/collection', 'collections')->name('collections');

Route::get('/category/{slug}', [CollectionController::class, 'show'])
    ->name('category.show');

Route::get('/category/{slug}/{id}', [CollectionController::class, 'only_read'])
    ->name('category.only');

Route::view('/contact-us', 'contact-us')->name('contact-us');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/blogs', [BlogController::class, 'index'])
    ->name('blogs');

Route::get('/blogs/{id}', [BlogController::class, 'show'])
    ->name('blogs.show');

Route::get('/shop', [ShopController::class, 'index'])
    ->name('shop');

Route::view('/faq', 'faq')->name('faq');