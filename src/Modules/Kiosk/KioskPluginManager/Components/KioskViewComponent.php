<?php
namespace Modules\Kiosk\KioskPluginManager\Components;

use Livewire\Component;
use Modules\Kiosk\Entities\Display;
use Modules\Kiosk\Entities\DisplayObject;

class KioskViewComponent extends Component {

    public $data;
    public $displayObjectId;

    public function mount(DisplayObject $object) {
        $this->displayObjectId = $object->id;
        $this->loadData();
    }

    protected function loadData() {
        $this->data = json_decode((DisplayObject::find($this->displayObjectId)->data));
    }

}