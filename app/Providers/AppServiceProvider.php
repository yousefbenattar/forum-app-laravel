<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import the View facade
use Illuminate\Support\Facades\Http;
use App\Models\BookMark;
use App\Observers\BookMarkObserver;
use App\Models\Comment;
use App\Observers\CommentObserver;
use App\Models\Follow;
use App\Observers\FollowObserver;
use App\Models\Like;
use App\Observers\LikeObserver;
use App\Models\Post;
use App\Models\News;
use App\Observers\PostObserver;
use App\Observers\NewsObserver;
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
        Post::observe(PostObserver::class);
        News::observe(NewsObserver::class);
        BookMark::observe(BookMarkObserver::class);
        Comment::observe(CommentObserver::class);
        Follow::observe(FollowObserver::class);
        Like::observe(LikeObserver::class);

        //Model::preventLazyLoading();
        // load youtube videos
        View::composer('components.left-side-bar', function ($view) {
            // Cache the videos for 24h minutes
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
            });
            ;
            $view->with('videos', $videos);
        });


    }
}
