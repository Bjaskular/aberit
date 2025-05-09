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
    }
}
