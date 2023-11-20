<?php
namespace Modules\DisplayPlugContainer\Livewire;

use Modules\Kiosk\KioskPluginManager\Components\KioskBuilderViewComponent;

class ContainerBuilderViewComponent extends KioskBuilderViewComponent {

    public function render() {
        return view("displayplugcontainer::livewire.builder-view");
    }
}