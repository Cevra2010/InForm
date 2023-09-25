<?php
namespace Modules\Container\Livewire;

use App\Components\ColorManager\HasColors;
use App\Components\DisplayBuilder\View;
use App\Models\DisplayObject;
use Livewire\Attributes\On;
use Livewire\Component;

class ContainerBuilderView extends View {

    use HasColors;

    public $displayObject;
    public $data;

    public function mount(DisplayObject $object) {
        $this->displayObject = $object;
        $this->data = $this->displayObject->data;
    }
    public function render() {
        return view("container::livewire.builder-view");
    }

    #[On('object-updated')]
    public function objectUpdated() {
        $this->displayObject->refresh();
        $this->data = $this->displayObject->data;
    }

}
