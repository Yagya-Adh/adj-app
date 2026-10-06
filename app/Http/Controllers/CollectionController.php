<?php

namespace App\Http\Controllers;

use App\Models\Collection;

class CollectionController extends Controller
{
    public function show(string $slug)
    {
        $categories = [
            'Rings' => [
                'name' => 'Rings',
                'db' => 'Rings',
                'image' => 'build/rings.avif',
            ],
            'Ear Rings' => [
                'name' => 'Ear Rings',
                'db' => 'Earrings',
                'image' => 'build/ear-rings.avif',
            ],
            'Bracelets' => [
                'name' => 'Bracelets',
                'db' => 'Bracelets',
                'image' => 'build/bracelets.avif',
            ],
            'Necklace' => [
                'name' => 'Necklace',
                'db' => 'Necklace',
                'image' => 'build/necklace.avif',
            ],
        ];

        $categories = collect($categories)->keyBy(
            fn ($category) => slugify($category['name'])
        )->all();

        $slug = slugify($slug);

        abort_unless(isset($categories[$slug]), 404);

        $category = $categories[$slug];

        $collections = Collection::whereRaw(
            'LOWER(category) = ?',
            [strtolower($category['db'])]
        )->get();

        return view('category', compact(
            'category',
            'collections',
            'slug'
        ));
    }

    public function only_read(string $slug, int $id)
    {
        $collection = Collection::findOrFail($id);

        return view('only-read', compact(
            'collection',
            'slug'
        ));
    }
}