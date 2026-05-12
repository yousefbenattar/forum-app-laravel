<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import the View facade
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
       // This ensures $categories is ALWAYS available to your sidebar component
        View::composer('components.left-side-bar', function ($view) {
            $view->with('categories', Category::orderBy('id','asc')->get());
        });
    }
}
