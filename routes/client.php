<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::view('/', 'home')->name('home');

Route::view('/collections', 'collections')->name('collections');

Route::get('/category/{slug}', function (string $slug) {
    $categories = [
        'rings' => [
            'name' => 'Rings',
            'image' => 'build/rings.avif',
        ],
        'ear-rings' => [
            'name' => 'Ear Rings',
            'image' => 'build/ear-rings.avif',
        ],
        'bracelets' => [
            'name' => 'Bracelets',
            'image' => 'build/bracelets.avif',
        ],
        'necklace' => [
            'name' => 'Necklace',
            'image' => 'build/necklace.avif',
        ],
    ];

    abort_unless(isset($categories[$slug]), 404);

    return view('category', [
        'category' => $categories[$slug],
        'slug' => $slug,
    ]);
})->name('category.show');

Route::view('/contact-us', 'contact-us')->name('contact-us');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::view('/blog', 'blog')->name('blog');

Route::view('/shop', 'shop')->name('shop');

Route::view('/faq', 'faq')->name('faq');