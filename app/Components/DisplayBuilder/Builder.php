<?php
namespace App\DisplayBuilder;

use App\Models\DisplayObject;
use Livewire\Attributes\On;
use Livewire\Component;

class Builder extends Component {

    public $displayObject = null;
    public $width;
    public $height;

    public function mount(DisplayObject $object) {
        $this->displayObject = $object;
        $this->display = $this->displayObject->display;
        $this->width = $this->displayObject->width;
        $this->height = $this->displayObject->height;
    }
    protected function updateDisplay() {
        $this->dispatch('object-updated',['object' => $this->displayObject->id]);
    }

    protected function updateData($array) {
        $this->displayObject->data = array_merge($this->displayObject->data,$array);
        $this->displayObject->save();
        $this->updateDisplay();
    }

    public function updatedWidth() {
        $this->displayObject->width = $this->width;
        $this->displayObject->save();
        $this->updateDisplay();
    }

    public function updatedHeight() {
        $this->displayObject->height = $this->height;
        $this->displayObject->save();
        $this->updateDisplay();
    }

    #[On('object-updated')]
    public function refreshMe() {
        $this->displayObject->refresh();
    }
}
