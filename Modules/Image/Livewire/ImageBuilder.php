<?php
namespace Modules\Image\Livewire;

use App\Components\DisplayBuilder\Builder;
use App\Components\DisplayBuilder\BuilderInterface;
use App\Models\DisplayObject;

class ImageBuilder extends Builder implements BuilderInterface {


    public $displayObject = null;
    public $url;

    public function mount(DisplayObject $object) {
        $this->displayObject = $object;
        $this->url = $this->displayObject->data['url'];
    }
    public function render() {
        return view("image::livewire.builder.builder");
    }

    public function updatedUrl() {
        $this->updateData(['url' => $this->url]);
    }
}
