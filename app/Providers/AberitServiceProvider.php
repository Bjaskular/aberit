<?php

namespace App\Providers;

use App\Http\Services;
use Illuminate\Support\ServiceProvider;

class AberitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(Services\Interfaces\IUserService::class, Services\UserService::class);
        $this->app->bind(Services\Interfaces\IPostService::class, Services\PostService::class);
        $this->app->bind(Services\Interfaces\ICommentService::class, Services\CommentService::class);
    }
}
