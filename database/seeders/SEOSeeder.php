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
            'meta_title' => 'Cupstack - Home',
            'meta_description' => 'Welcome to Cupstack. Explore premium tech solutions crafted with care.',
            'meta_keywords' => 'Cupstack, home, tech, solutions',
            'canonical_url' => url('/'),
            'og_title' => 'Cupstack - Home',
            'og_description' => 'Discover Cupstack’s homepage and digital innovation.',
            'og_image' => 'cupstack.png',
            'twitter_title' => 'Cupstack Home',
            'twitter_description' => 'Explore Cupstack – Your digital partner.',
            'twitter_image' => 'cupstack.png',
            ],
            [
                'page' => 'home',
                'meta_title' => 'Cupstack - Home',
                'meta_description' => 'Welcome to Cupstack. Explore premium tech solutions crafted with care.',
                'meta_keywords' => 'Cupstack, home, tech, solutions',
                'canonical_url' => url('/'),
                'og_title' => 'Cupstack - Home',
                'og_description' => 'Discover Cupstack’s homepage and digital innovation.',
                'og_image' => 'cupstack.png',
                'twitter_title' => 'Cupstack Home',
                'twitter_description' => 'Explore Cupstack – Your digital partner.',
                'twitter_image' => 'cupstack.png',
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