<?php

namespace Modules\Newsfeed\Providers;

use App\Components\ContentManager\ContentManager;
use App\Components\SidebarManager\SidebarManager;
use App\Models\User;
use App\ModuleManager\Facades\ModuleManager;
use Components\InformDataTable\DataTable;
use Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\View as FacadesView;
use Livewire;
use Modules\Newsfeed\Entities\Article;
use Modules\Newsfeed\Entities\Newsfeed;
use Modules\Newsfeed\Livewire\Article\ArticleEditor;
use Modules\Newsfeed\Livewire\Builder;
use Modules\Newsfeed\Livewire\BuilderView;
use Modules\Newsfeed\Livewire\Dashboard\ArticleList;
use Modules\Newsfeed\Livewire\Dashboard\ArticleListEdit;
use Modules\Newsfeed\Livewire\View;

class NewsfeedServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Newsfeed';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'newsfeed';

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

        /** register modules livewire components */
        $this->regsiterLivewireComponents();

        /** register module */
        ModuleManager::register($this->moduleNameLower,true,Builder::class,BuilderView::class,View::class,[]);

        /** Register edit table */
        DataTable::create('newsfeed::edit-table')
        ->withPivot('createdBy')
        ->withoutWrapper()
        ->sortExpect('createdBy')
        ->setModelBinding(Article::class)
        ->addWhereCondition('data->newsfeed_id')
        ->addAction('','newsfeed::article.editor','id')
            ->icon("edit")
            ->css("text-yellow-500")
        ->addAction('','newsfeed::article.publish','id')
            ->icon("globe")
            ->css("text-teal-700")
            ->asPost()
            ->confirmation(function() {
                
            },'Beitrag wirklich veröffentlichen?')
        ->addColumn('data->title','Titel')
        ->addColumn('createdBy','Erstellt von')
            ->callback(function($row) {
                return $row->createdBy->fullName();
            });

        /** register sidebar elements */
        $this->registerSidebarElements();

        /** Newsfeeds in der Sidebar registrieren */
        Gate::define('newsfeed::can-write-or-publish',function(User $user,$newsfeed) {
            if($newsfeed->canWrite($user)) {
                return true;
            }
            return false;
        });

        foreach(Newsfeed::all() as $newsfeed) {
            SidebarManager::register($newsfeed->name)
            ->setIcon(($newsfeed->icon ? $newsfeed->icon : 'newspaper'))
            ->setName($newsfeed->name)
            ->setRoute("newsfeed::dashbaord",$newsfeed->id)
            ->after('newsfeed-create')
            ->setGate('newsfeed::can-write-or-publish',$newsfeed);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
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
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/group-selector.php'), 'group-selector'
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

    public function regsiterLivewireComponents() {
        Livewire::component("newsfeed::article-editor",ArticleEditor::class);
        Livewire::component("newsfeed::dashboard.article-list",ArticleList::class);
        Livewire::component("newsfeed::dashboard.article-list-edit",ArticleListEdit::class);
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

    public function registerSidebarElements() :void  {

    SidebarManager::register('newsfeed')
        ->setName('Newsfeed')
        ->after('modules')
        ->setIcon('newspaper');

    SidebarManager::register('newsfeed-index')
        ->setName('Newsfeed Übersicht')
        ->setParent('newsfeed')
        ->setIcon('newspaper')
        ->setRoute("newsfeed::index");

    SidebarManager::register('newsfeed-create')
        ->setName('Newsfeed erstellen')
        ->setParent('newsfeed')
        ->setIcon('plus')
        ->setRoute("newsfeed::add-newsfeed");
    }
}
