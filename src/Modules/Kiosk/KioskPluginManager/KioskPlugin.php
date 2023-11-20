<?php
namespace Modules\Kiosk\KioskPluginManager;

use Livewire;

class KioskPlugin {

    public $name;
    public $slug;
    protected $builderComponent;
    protected $builderViewComponent;
    protected $viewComponent;
    protected $icon = null;
    protected $defaultData = [];

    CONST DEFAULT_ICON = 'layer-group';

    public function __construct(string $slug) {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug() : string {
        return $this->slug;
    }

    public function setName(string $name) : KioskPlugin {
        $this->name = $name;
        return $this;
    }

    public function getName() : string {
        if(!$this->name) {
            return $this->slug;
        }
        return $this->name;
    }

    public function setIcon(string $icon) : KioskPlugin {
        $this->icon = $icon;
        return $this;
    }

    public function getIcon() : string {
        if(!$this->icon) {
            return self::DEFAULT_ICON;
        }
        return $this->icon;
    }

    public function registerBuilderComponent($builderComponent) : KioskPlugin {
        $this->builderComponent = $builderComponent;
        Livewire::component($this->slug."::builderComponent",$builderComponent);
        return $this;
    }

    public function registerBuilderViewComponent($builderViewComponent) : KioskPlugin {
        $this->builderViewComponent = $builderViewComponent;
        Livewire::component($this->slug."::builderViewComponent",$builderViewComponent);
        return $this;
    }

    public function registerViewComponent($viewComponent) : KioskPlugin {
        $this->viewComponent = $viewComponent;
        Livewire::component($this->slug."::viewComponent",$viewComponent);
        return $this;
    }

    public function getBuilderComponent() : string {
        return $this->slug."::builderComponent";
    }

    public function getBuilderViewComponent() : string {
        if(!$this->builderViewComponent) {
            return $this->getViewComponent();
        }
        return $this->slug."::builderViewComponent";
    }

    public function getViewComponent() : string {
        return $this->slug."::viewComponent";
    }

    public function setDefaultData(array $data) : KioskPlugin {
        $this->defaultData = $data;
        return $this;
    }

    public function getDefaultData() : array {
        return $this->defaultData;
    }

    public function getDefaultDataAsJson() : string {
        return json_encode($this->getDefaultData());
    }
}