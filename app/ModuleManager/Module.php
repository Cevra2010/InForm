<?php
namespace App\ModuleManager;

use App\ModuleManager\Exceptions\LaravelModuleNotFoundException;

class Module extends ModuleManager {


    /**
     * @var
     */
    public $moduleName;
    /**
     * @var
     */
    protected $displayTouchCompatible;

    /**
     * @var
     */
    protected $laravelModule;

    /**
     * @var
     */
    protected $builderComponent;

    /**
     * @var
     */
    protected $builderViewComponent;

    /**
     * @var null
     */
    protected $viewComponent = null;

    /**
     * @var
     */
    protected $moduleInitData;

    /**
     * @param string $moduleName Module-Name
     * @param bool $displayTouchCompatible Display Touch enabled/disabled
     * @param $builderComponent Component for the Builder
     * @param $builderViewComponent Component for the View in Builder
     * @param $viewComponent View in the Presenter
     * @param $moduleInitData Initializing Object data
     * @return Module
     * @throws LaravelModuleNotFoundException
     */
    public function register(string $moduleName, bool $displayTouchCompatible, $builderComponent, $builderViewComponent, $viewComponent, $moduleInitData) {
        $registeringModule = new Module();
        if(!$registeringModule->laravelModule = \Nwidart\Modules\Facades\Module::find($moduleName)) {
            throw new LaravelModuleNotFoundException('The Module "'.$moduleName.'" wasn´t found!');
        }
        $registeringModule->moduleName = $moduleName;
        $registeringModule->displayTouchCompatible = $displayTouchCompatible;
        $registeringModule->builderComponent = $builderComponent;
        $registeringModule->viewComponent = $viewComponent;
        $registeringModule->builderViewComponent = $builderViewComponent;
        $registeringModule->moduleInitData = $moduleInitData;
        parent::$modules->add($registeringModule);
        return $registeringModule;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->moduleName;
    }

    /**
     * @return mixed
     */
    public function getPath() {
        return $this->laravelModule->getPath();
    }

    /**
     * @return mixed
     */
    public function isDisplayTouchable() {
        return $this->displayTouchCompatible;
    }

    /**
     * @return mixed
     */
    public function getBuilderComponent() {
        return $this->builderComponent;
    }

    /**
     * @return mixed
     */
    public function getBuilderViewComponent() {
        return $this->builderViewComponent;
    }

    /**
     * @return null
     */
    public function getViewComponent() {
        if($this->viewComponent == null) {
            return $this->builderViewComponent;
        }
        return $this->viewComponent;
    }

    /**
     * @return mixed
     */
    public function isDisabled() {
        return $this->laravelModule->isDisabled();
    }

    /**
     * @return false|string
     */
    public function getModuleInitDataAsJson() {
        return json_encode($this->moduleInitData);
    }

    /**
     * @return mixed
     */
    public function getModuleInitData() {
        return $this->moduleInitData;
    }
}
