<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Job;
use App\Observers\JobObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Post;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\Schema;

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
        $user = null;

        if (Schema::hasTable('users')) {
            $user = User::first();
        }
        View::share('user', $user ?? null);

        if (Schema::hasTable('comments')) {
            $pendingCommentsCount = Comment::where('approved', false)->count();
            View::share('pendingCommentsCount', $pendingCommentsCount > 0 ? $pendingCommentsCount : 0);

            $approvedCommentsCount = Comment::where('approved', true)->count();
            View::share('approvedCommentsCount', $approvedCommentsCount > 0 ? $approvedCommentsCount : 0);
        } else {
            View::share('pendingCommentsCount', 0);
            View::share('approvedCommentsCount', 0);
        }

        Post::observe(PostObserver::class);
        Job::observe(JobObserver::class);
    }
}
