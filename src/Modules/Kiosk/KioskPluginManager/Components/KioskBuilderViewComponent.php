<?php
namespace Modules\Kiosk\KioskPluginManager\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Kiosk\Entities\Display;
use Modules\Kiosk\Entities\DisplayObject;

class KioskBuilderViewComponent extends Component {

    public $data;
    public $displayObjectId;
    public $zoomFactor;

    public function mount(DisplayObject $object,$zoomFactor) {
        $this->zoomFactor = $zoomFactor;
        $this->displayObjectId = $object->id;
        $this->loadData();
    }

    public function calcSize($size) {
        return $size / 100 * $this->zoomFactor;
    }

    #[On('zoom-factor')]
    public function zoomFactorChanged($zoomFactor) {
        $this->zoomFactor = $zoomFactor;
    }

    #[On('object-data-updated')]
    public function objectDataUpdated() {
        $this->loadData();
    }

    protected function loadData() {
        $this->data = json_decode((DisplayObject::find($this->displayObjectId)->data));
    }

    public function storeData() {
        $object = DisplayObject::find($this->displayObjectId);
        $object->data = json_encode($this->data);
        $object->save();
    }

    public function updated($property) {
        if(substr($property,0,5) == "data.") {
            $this->storeData();
            $this->dispatch("object-data-updated",$this->displayObjectId);
        }
    }

}