<?php
namespace Components\InformDataTable;

use Components\InformDataTable\Components\DataTableViewComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class InformDataTableServiceProvider extends ServiceProvider {

    public function register(): void
    {
        $this->app->bind('inform-data-table', function($app) {
            return new DataTable();
        });
        
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'inform-data-table');

        DataTable::boot();

        Blade::component('inform-data-table', DataTableViewComponent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }

}