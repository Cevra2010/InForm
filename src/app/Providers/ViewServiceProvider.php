<?php

namespace App\Providers;

use App\Components\SidebarManager\SidebarManager;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        /*
        FacadesView::composer('layouts.backend.menu',function(View $view) {
            $view->with('inFormSidebarObjects',SidebarManager::getObjects());
        });
        */
    }
}
