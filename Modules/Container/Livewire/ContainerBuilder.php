<?php
namespace Modules\Container\Livewire;

use App\Components\DisplayBuilder\Builder;
use App\Components\DisplayBuilder\BuilderInterface;
use App\Models\DisplayObject;
use Livewire\Attributes\On;

class ContainerBuilder extends Builder implements BuilderInterface {

    use \App\Components\ColorManager\HasColors;

    public $displayObject = null;
    public $display = null;
    public $width;
    public $height;

    public $shadow;

    public $rounded;

    public $border;

    public function mount(DisplayObject $object) {
        parent::mount($object);
        $this->shadow = $this->displayObject->data['shadow'];
        $this->rounded = $this->displayObject->data['rounded'];
        $this->border = $this->displayObject->data['border'];
     }
    public function render() {
        return view("container::livewire.builder");
    }

    public function fullWidth() {
        $this->displayObject->width = $this->display->width;
        $this->width = $this->display->width;
        $this->displayObject->pos_x = 0;
        $this->displayObject->save();
        $this->updateDisplay();
    }


    public function updatedShadow() {
        $this->updateData(['shadow' => $this->shadow]);
    }

    public function updatedRounded() {
        $this->updateData(['rounded' => $this->rounded]);
    }

    public function updatedBorder() {
        $this->updateData(['border' => $this->border]);
    }
}
