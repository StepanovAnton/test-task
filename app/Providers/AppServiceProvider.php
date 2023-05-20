<?php

namespace App\Providers;

use App\Repositories\Interfaces\VisitRepository;
use App\Repositories\RedisVisitRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VisitRepository::class, RedisVisitRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
