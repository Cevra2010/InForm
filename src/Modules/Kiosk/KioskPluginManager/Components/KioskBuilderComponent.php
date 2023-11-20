<?php
namespace Modules\Kiosk\KioskPluginManager\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Kiosk\Entities\Display;
use Modules\Kiosk\Entities\DisplayObject;

class KioskBuilderComponent extends Component {

    public $data;
    public $displayObjectId;

    public function mount(DisplayObject $object) {
        $this->displayObjectId = $object->id;
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

    #[On('object-data-updated')]
    public function objectDataUpdated() {
        $this->loadData();
    }

    public function updated($property) {
        if(substr($property,0,5) == "data.") {
            $this->storeData();
            $this->dispatch("object-data-updated",$this->displayObjectId);
        }
    }

    #[On('select-object')]
    public function pluginAdded($objectId) {
        $this->displayObjectId = $objectId;
        $this->loadData();
    }
}