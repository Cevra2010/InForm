<?php
namespace Modules\Image\Livewire;

use App\Models\DisplayObject;
use Livewire\Component;

class ImageBuilder extends Component {


    public $displayObject = null;

    public function mount(DisplayObject $object) {
        $this->displayObject = $object;
    }
    public function render() {
        return view("image::livewire.builder.menu");
    }

}
