<?php
namespace Modules\DisplayTextPlugin\Livewire;

use Modules\Kiosk\KioskPluginManager\Components\KioskBuilderComponent;

class DisplayTextBuilderComponent extends KioskBuilderComponent {

    public function render() {
        return view("displaytextplugin::livewire.builder");
    }

}