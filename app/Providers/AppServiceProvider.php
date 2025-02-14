<?php

namespace App\Providers;

use App\Models\Comment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

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
        $user = User::first();
        View::share('user', $user ?? null);

        $pendingCommentsCount = Comment::where('approved', false)->count();
        View::share('pendingCommentsCount', $pendingCommentsCount > 0 ? $pendingCommentsCount : 0);

        $approvedCommentsCount = Comment::where('approved', true)->count();
        View::share('approvedCommentsCount', $approvedCommentsCount > 0 ? $approvedCommentsCount : 0);
    }
}
