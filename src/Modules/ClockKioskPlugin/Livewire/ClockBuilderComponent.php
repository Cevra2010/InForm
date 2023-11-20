<?php
namespace Modules\ClockKioskPlugin\Livewire;

use Modules\Kiosk\KioskPluginManager\Components\KioskBuilderComponent;

class ClockBuilderComponent extends KioskBuilderComponent {
    public function render() {
        return view("clockkioskplugin::builder");
    }
}