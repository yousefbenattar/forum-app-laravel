<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import the View facade
use Illuminate\Support\Facades\Http;

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
        // Model::preventLazyLoading();

        View::composer('components.left-side-bar', function ($view) {
            // Cache the videos for 60 minutes
            $videos = cache()->remember('youtube_videos', 86400, function () {
                $apiKey = env('YOUTUBE_API_KEY');
                $channelId = 'UCs9Uo3cwoLRJhJKcnpsYwZA'; // Use the UC... ID here

                $response = Http::get("https://www.googleapis.com/youtube/v3/search", [
                    'key' => $apiKey,
                    'channelId' => $channelId,
                    'part' => 'snippet',
                    'order' => 'date',
                    'maxResults' => 10,
                    'type' => 'video'
                ]);

                return $response->json()['items'] ?? [];
            });;
            $view->with('videos', $videos);
        });


    }
}
