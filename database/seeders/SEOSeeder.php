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
                'page' => 'contact-us',
                'meta_title' => 'Contact Adjewellers - We Would Love to Hear From You',
                'meta_description' => 'Get in touch with Adjewellers for jewellery enquiries, personalized assistance, and support. We are here to help you find something truly special.',
                'meta_keywords' => 'contact Adjewellers, jewellery enquiries, jewelry support, fine jewelry, luxury jewelry, Adjewellers contact',
                'canonical_url' => url('/contact-us'),
                'og_title' => 'Contact Adjewellers - We Would Love to Hear From You',
                'og_description' => 'Get in touch with Adjewellers for jewellery enquiries, personalized assistance, and support.',
                'og_image' => 'adjewellers.png',
                'twitter_title' => 'Contact Adjewellers - We Would Love to Hear From You',
                'twitter_description' => 'Get in touch with Adjewellers for jewellery enquiries, personalized assistance, and support.',
                'twitter_image' => 'adjewellers.png',
            ],
            [
                'page' => 'collection',
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
                'page' => 'blogs',
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
            [
                'page' => 'category/rings',
                'meta_title' => 'Adjewellers Rings - Timeless Elegance',
                'meta_description' => 'Explore the exquisite rings collection at Adjewellers, featuring timeless designs crafted to celebrate elegance, beauty, and individuality.',
                'meta_keywords' => 'Adjewellers rings, jewelry rings, fine rings, luxury rings, elegant rings, gold rings',
                'canonical_url' => url('/category/rings'),
                'og_title' => 'Adjewellers Rings - Timeless Elegance',
                'og_description' => 'Discover timeless and elegant rings crafted to make every moment beautifully unforgettable.',
                'og_image' => 'adjewellers.png',
                'twitter_title' => 'Adjewellers Rings - Timeless Elegance',
                'twitter_description' => 'Discover timeless and elegant rings crafted to celebrate your individuality.',
                'twitter_image' => 'adjewellers.png',
            ],
            
            [
                'page' => 'category/necklace',
                'meta_title' => 'Adjewellers Necklaces - Graceful Beauty',
                'meta_description' => 'Discover elegant necklaces from Adjewellers, thoughtfully crafted to add timeless beauty and sophistication to every occasion.',
                'meta_keywords' => 'Adjewellers necklaces, jewelry necklaces, fine necklaces, luxury necklaces, elegant necklaces, gold necklaces',
                'canonical_url' => url('/category/necklace'),
                'og_title' => 'Adjewellers Necklaces - Graceful Beauty',
                'og_description' => 'Explore refined necklaces designed to bring timeless elegance and graceful beauty to every occasion.',
                'og_image' => 'adjewellers.png',
                'twitter_title' => 'Adjewellers Necklaces - Graceful Beauty',
                'twitter_description' => 'Explore refined necklaces designed to bring timeless elegance and graceful beauty.',
                'twitter_image' => 'adjewellers.png',
            ],
            
            [
                'page' => 'category/bracelets',
                'meta_title' => 'Adjewellers Bracelets - Effortless Sophistication',
                'meta_description' => 'Explore the elegant bracelet collection at Adjewellers, featuring refined designs created to complement your style with timeless sophistication.',
                'meta_keywords' => 'Adjewellers bracelets, jewelry bracelets, fine bracelets, luxury bracelets, elegant bracelets, gold bracelets',
                'canonical_url' => url('/category/bracelets'),
                'og_title' => 'Adjewellers Bracelets - Effortless Sophistication',
                'og_description' => 'Discover refined bracelets crafted to complement your style with effortless elegance and sophistication.',
                'og_image' => 'adjewellers.png',
                'twitter_title' => 'Adjewellers Bracelets - Effortless Sophistication',
                'twitter_description' => 'Discover refined bracelets crafted to complement your style with effortless elegance.',
                'twitter_image' => 'adjewellers.png',
            ],
            
            [
                'page' => 'category/ear-rings',
                'meta_title' => 'Adjewellers Earrings - Elegant Radiance',
                'meta_description' => 'Discover beautiful earrings from Adjewellers, featuring sophisticated designs crafted to bring elegance and radiance to every look.',
                'meta_keywords' => 'Adjewellers earrings, jewelry earrings, fine earrings, luxury earrings, elegant earrings, gold earrings',
                'canonical_url' => url('/category/ear-rings'),
                'og_title' => 'Adjewellers Earrings - Elegant Radiance',
                'og_description' => 'Explore sophisticated earrings designed to bring timeless elegance and radiant beauty to every look.',
                'og_image' => 'adjewellers.png',
                'twitter_title' => 'Adjewellers Earrings - Elegant Radiance',
                'twitter_description' => 'Explore sophisticated earrings designed to bring timeless elegance and radiant beauty.',
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