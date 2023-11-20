<?php
namespace Modules\DisplayPlugContainer\Livewire;

use Modules\Kiosk\KioskPluginManager\Components\KioskBuilderComponent;

class ContainerBuilderComponent extends KioskBuilderComponent {

    public function render() {
        return view("displayplugcontainer::livewire.builder");
    }
}