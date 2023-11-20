<?php
namespace Modules\ClockKioskPlugin\Livewire;

use Modules\Kiosk\KioskPluginManager\Components\KioskBuilderViewComponent;

class ClockBuilderViewComponent extends KioskBuilderViewComponent {
    public function render() {
        return view("clockkioskplugin::builder-view");
    }
}