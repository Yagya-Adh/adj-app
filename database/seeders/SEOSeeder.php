<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SEO;

class SeoSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [

            [
                'page' => '/',
                'meta_title' => 'Adjewellers - Where Luxury Shines',
                'meta_description' => 'Discover timeless jewellery crafted to celebrate elegance, beauty, and individuality at Adjewellers.',
                'meta_keywords' => 'Adjewellers, fine jewelry, luxury jewelry, timeless jewelry, elegant jewelry',
                'canonical_url' => url('/'),
                'og_title' => 'Adjewellers - Where Luxury Shines',
                'og_description' => 'Discover timeless pieces crafted to celebrate elegance, beauty, and individuality.',
                'og_image' => 'adjewellers.png',
                'twitter_title' => 'Adjewellers - Where Luxury Shines',
                'twitter_description' => 'Discover timeless pieces crafted to celebrate elegance, beauty, and individuality.',
                'twitter_image' => 'adjewellers.png',
            ],
        
            [
                'page' => 'home',
                'meta_title' => 'Adjewellers - Where Luxury Shines',
                'meta_description' => 'Discover timeless jewellery crafted to celebrate elegance, beauty, and individuality at Adjewellers.',
                'meta_keywords' => 'Adjewellers, fine jewelry, luxury jewelry, timeless jewelry, elegant jewelry',
                'canonical_url' => url('/'),
                'og_title' => 'Adjewellers - Where Luxury Shines',
                'og_description' => 'Discover timeless pieces crafted to celebrate elegance, beauty, and individuality.',
                'og_image' => 'adjewellers.png',
                'twitter_title' => 'Adjewellers - Where Luxury Shines',
                'twitter_description' => 'Discover timeless pieces crafted to celebrate elegance, beauty, and individuality.',
                'twitter_image' => 'adjewellers.png',
            ],
        
            [
                'page' => 'collections',
                'meta_title' => 'Adjewellers Collections - Where Beauty Glows',
                'meta_description' => 'Explore a refined collection of jewellery designed to make every moment beautifully unforgettable.',
                'meta_keywords' => 'Adjewellers collections, jewelry collection, fine jewelry, luxury jewelry, elegant jewelry',
                'canonical_url' => url('/collections'),
                'og_title' => 'Adjewellers Collections - Where Beauty Glows',
                'og_description' => 'Explore a refined collection designed to make every moment beautifully unforgettable.',
                'og_image' => 'adjewellers.png',
                'twitter_title' => 'Adjewellers Collections - Where Beauty Glows',
                'twitter_description' => 'Explore a refined collection designed to make every moment beautifully unforgettable.',
                'twitter_image' => 'adjewellers.png',
            ],
        
            [
                'page' => 'blog',
                'meta_title' => 'Adjewellers Blog - Timelessly Yours',
                'meta_description' => 'Explore jewellery stories, inspiration, style, and insights curated for those who appreciate timeless elegance and the extraordinary.',
                'meta_keywords' => 'Adjewellers blog, jewelry blog, jewelry inspiration, jewelry style, fine jewelry',
                'canonical_url' => url('/blog'),
                'og_title' => 'Adjewellers Blog - Timelessly Yours',
                'og_description' => 'A curated expression of sophistication, crafted for those who appreciate the extraordinary.',
                'og_image' => 'adjewellers.png',
                'twitter_title' => 'Adjewellers Blog - Timelessly Yours',
                'twitter_description' => 'Discover jewellery stories, inspiration, and timeless elegance from Adjewellers.',
                'twitter_image' => 'adjewellers.png',
            ],
        
        ];
        

        foreach ($pages as $data) {
            SEO::updateOrCreate(
                ['page' => $data['page']],
                $data
            );
        }
    }
}