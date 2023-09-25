<?php

namespace App\Providers;

use App\Components\ColorManager\ColorManager;
use App\Components\ColorManager\ColorPicker;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ColorManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        ColorManager::registerViewNamespace();
        \Livewire::component('inform-colorpicker',ColorPicker::class);
    }
}
