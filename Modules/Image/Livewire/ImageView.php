<?php
namespace Modules\Image\Livewire;

use App\Models\DisplayObject;
use Livewire\Attributes\On;
use Livewire\Component;

class ImageView extends Component {


    public $displayObject = null;

    public function mount(DisplayObject $object) {
        $this->displayObject = $object;
    }
    public function render() {
        return view("image::livewire.builder.view");
    }

    #[On('object-updated')]
    public function objectUpdated() {
        $this->displayObject->refresh();
    }

}
