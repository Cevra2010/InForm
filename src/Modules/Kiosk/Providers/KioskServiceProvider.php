<?php

namespace Modules\Kiosk\Providers;

use App\Components\SidebarManager\SidebarManager;
use Components\InformDataTable\DataTable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire;
use Modules\Kiosk\Entities\Display;
use Modules\Kiosk\KioskPluginManager\KioskPluginManager;
use Modules\Kiosk\Livewire\Builder\Base;
use Modules\Kiosk\Livewire\Builder\BuilderSidebar;
use Modules\Kiosk\Livewire\Display\OnlineState;
use Modules\Kiosk\Livewire\Display\ScreenSize;
use Illuminate\Support\Str;

class KioskServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Kiosk';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'kiosk';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerLivewireComponents();

        SidebarManager::register('plugin-kiosk')
        ->setName('Kiosk')
        ->setIcon('display')
        ->after('modules');

        SidebarManager::register('display-overview')
        ->setName('Bildschirme')
        ->setIcon('display')
        ->setParent('plugin-kiosk')
        ->setRoute("kiosk::display.list");

        SidebarManager::register('display-add')
        ->setName('Bildschirm anlegen')
        ->setIcon('plus')
        ->setParent('plugin-kiosk')
        ->setRoute("kiosk::display.create");
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        
        /** initialize plugin manager */
        KioskPluginManager::init();
        
        DataTable::create('kiosk-displays-data-table')
        ->setModelBinding(Display::class)
        ->addColumn('id','Id')
        ->addColumn('name','Name')->access("user.edit.create")
        ->addColumn('width','Breite')->callback(function($row) {
            return $row->width.'px';
        })
        ->addColumn('height','Höhe')->callback(function($row) {
            return $row->height.'px';
        })
        ->headerUppercase()
        ->sortExpect('status')
        ->searchOnly(['name'])
        ->linkRows('kiosk::display.edit','id')
        ->addColumn('created_at','Erstellt','datetime')
        ->addColumn('updated_at','Letzte Änderung','datetime')
        ->addColumn('status','Status')->callback(function($row) {
            return Blade::render('<livewire:kiosk::display.online-state :key="'.$row->id.'" display="'.$row->id.'"/>');
        });
    }

    protected function registerLivewireComponents() {
        Livewire::component("kiosk::display.online-state",OnlineState::class);
        Livewire::component("kiosk::display.screen-size",ScreenSize::class);
        Livewire::component("kiosk::builder.base",Base::class);
        Livewire::component("kiosk::builder.sidebar",BuilderSidebar::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
