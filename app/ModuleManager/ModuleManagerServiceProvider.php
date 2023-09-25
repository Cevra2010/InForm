<?php
namespace App\ModuleManager;

use Illuminate\Support\ServiceProvider;

class ModuleManagerServiceProvider extends ServiceProvider {
    public function register(): void
    {
        ModuleManager::boot();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind('inform-module', function($app) {
            return new Module();
        });
    }
}
