<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SEO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $routeName = request()->route()?->getName();  
            $uri = request()->path();  

            $seo = SEO::where('page', $routeName)
                        ->orWhere('page', $uri)
                        ->first();

            if (!$seo) {
                $seo = (object) [
                    'meta_title' => config('app.name', 'Cupstack'),
                    'meta_description' => 'Default Cupstack description',
                    'meta_keywords' => 'cupstack, laravel, website',
                    'canonical_url' => url()->current(),
                    'og_title' => config('app.name', 'Cupstack'),
                    'og_description' => 'Default Open Graph description',
                    'og_image' => asset('default-og.png'),
                    'twitter_title' => config('app.name', 'Cupstack'),
                    'twitter_description' => 'Default Twitter description',
                    'twitter_image' => asset('default-og.png'),
                ];
            }

            $view->with('seo', $seo);
        });
    }
}