<?php
namespace Modules\ClockKioskPlugin\Livewire;

use Modules\Kiosk\KioskPluginManager\Components\KioskViewComponent;

class ClockViewComponent extends KioskViewComponent {
    public function render() {
        return view("clockkioskplugin::view");
    }
}