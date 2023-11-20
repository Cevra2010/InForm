<?php
namespace Modules\DisplayTextPlugin\Livewire;

use Modules\Kiosk\KioskPluginManager\Components\KioskBuilderViewComponent;

class DisplayTextBuilderViewComponent extends KioskBuilderViewComponent {

    public $text;

    public function render() {
        return view("displaytextplugin::livewire.builder-view");
    }

    public function updatedText() {
            
    }

}