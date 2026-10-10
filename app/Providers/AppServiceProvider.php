<?php

namespace App\Providers;

use App\Models\SEO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            // SEO data
            $routeName = request()->route()?->getName();
            $uri = request()->path();

            $seo = SEO::query()
                ->where('page', $routeName)
                ->orWhere('page', $uri)
                ->first();

            $seo ??= (object) [
                'meta_title' => config('app.name', 'Adjewellers'),
                'meta_description' => 'Default Adjewellers description',
                'meta_keywords' => 'Adjewellers, laravel, website',
                'canonical_url' => url()->current(),
                'og_title' => config('app.name', 'Adjewellers'),
                'og_description' => 'Default Open Graph description',
                'og_image' => asset('default-og.png'),
                'twitter_title' => config('app.name', 'Adjewellers'),
                'twitter_description' => 'Default Twitter description',
                'twitter_image' => asset('default-og.png'),
            ];

            $view->with('seo', $seo);

            // Notifications for authenticated users
            $notifications = collect();
            $unreadNotificationCount = 0;

            if (Auth::check()) {
                $user = Auth::user();

                $notifications = $user->notifications()
                    ->latest()
                    ->take(10)
                    ->get();

                $unreadNotificationCount = $user
                    ->unreadNotifications()
                    ->count();
            }

            $view->with([
                'notifications' => $notifications,
                'unreadNotificationCount' => $unreadNotificationCount,
            ]);
        });
    }
}