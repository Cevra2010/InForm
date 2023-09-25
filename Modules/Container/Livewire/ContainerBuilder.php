<?php
namespace Modules\Conatiner\Livewire;

use App\Models\DisplayObject;
use Livewire\Component;

class BuilderComponent extends Component {

    public $displayObject;

    public function mount(DisplayObject $object) {
        $this->displayObject = $object;
    }
    public function render() {
        return view("container::livewire.builder");
    }

}
