<?php
namespace Modules\DisplayTextPlugin\Livewire;

use Modules\Kiosk\KioskPluginManager\Components\KioskViewComponent;

class DisplayTextViewComponent extends KioskViewComponent {

    public function render() {
        return view("displaytextplugin::livewire.view");
    }

}