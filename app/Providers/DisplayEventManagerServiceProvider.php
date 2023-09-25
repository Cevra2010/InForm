<?php

namespace App\Providers;

use App\Components\DisplayEventManager\DisplayEventManager;
use Illuminate\Support\ServiceProvider;

class DisplayEventManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('display-event', function ($app) {
            return new DisplayEventManager();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
