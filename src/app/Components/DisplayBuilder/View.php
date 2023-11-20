<?php

namespace App\Components\DisplayBuilder;

use Livewire\Attributes\On;
use Livewire\Component;

class View extends Component {

    public $displayObject = null;
    public function mount(\App\Models\DisplayObject $object)
    {
        $this->displayObject = $object;
        $this->display = $this->displayObject->display;
        $this->width = $this->displayObject->width;
        $this->height = $this->displayObject->height;
    }

    #[On('object-updated')]
    public function updateMyself() {
        $this->displayObject->refresh();
    }

    public function updateData($array) {
        // DO-NOTHING
    }
}
