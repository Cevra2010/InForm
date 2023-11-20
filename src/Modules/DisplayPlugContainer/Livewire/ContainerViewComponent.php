<?php
namespace Modules\DisplayPlugContainer\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Kiosk\KioskPluginManager\Components\KioskViewComponent;

class ContainerViewComponent extends KioskViewComponent {

    public $fontSize = 10;
    public $factor = 100;

    public function render() {
        return view("displayplugcontainer::livewire.view");
    }

    #[On('zoom-factor')]
    public function zoomFactorChanged($factor) {
        $this->factor = $factor;
    }

    public function getFontSize() {
        return $this->fontSize / 100 * $this->factor;
    }

}