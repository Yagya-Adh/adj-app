<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CollectionController;

Route::get('/',[HomeController::class,'index'])->name('home');

Route::view('/collection', 'collections')->name('collections');
Route::get('/category/{slug}', [CollectionController::class, 'show'])
    ->name('category.show');
Route::get('/category/{slug}/{id}', [CollectionController::class, 'only_read'])
    ->name('category.only');

Route::view('/contact-us', 'contact-us')->name('contact-us');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');
/* blogs */
Route::get('blogs',[BlogController::class,'index'])->name('blogs');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

Route::view('/shop', 'shop')->name('shop');

Route::view('/faq', 'faq')->name('faq');