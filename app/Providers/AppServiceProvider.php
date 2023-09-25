<?php

namespace App\Providers;

use App\Auth\DefaultLogin;
use App\AuthManager\AuthRegistry;
use App\Components\IconPicker\IconPicker;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\ServiceProvider;
use Modules\LdapAuth\Http\Controllers\LdapAuthController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AuthRegistry::register('login',DefaultLogin::class);
        IconPicker::boot();
    }
}