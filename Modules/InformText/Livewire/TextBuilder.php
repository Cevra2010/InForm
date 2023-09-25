<?php
namespace Modules\InformText\Livewire;

use App\Components\ColorManager\HasColors;
use App\Components\DisplayBuilder\Builder;
use App\Components\DisplayBuilder\BuilderInterface;
use App\Models\DisplayObject;
use Livewire\Attributes\On;

class TextBuilder extends Builder implements BuilderInterface {

    use HasColors;
    public $text;
    public $bold;
    public $cursiv;
    public $family;
    public $size;
    public function mount(DisplayObject $object)
    {
        parent::mount($object);
        $this->text = $this->displayObject->data['text'];
        $this->bold = $this->displayObject->data['bold'];
        $this->cursiv = $this->displayObject->data['cursiv'];
        $this->family = $this->displayObject->data['font-family'];
        $this->size = $this->displayObject->data['font-size'];
    }

    public function render()
    {
        return view("informtext::livewire.builder");
    }

    public function updatedText() {
        $this->updateData(['text' => $this->text]);
    }

    public function updatedSize() {
        if($this->size <= 0) {
            $this->size = 0.1;
        }
        $this->updateData(['font-size' => $this->size]);
    }

    public function updatedCursiv() {
        $this->updateData(['cursiv' => $this->cursiv]);
    }

    public function updatedFamily() {
        $this->updateData(['font-family' => $this->family]);
    }

    #[On('text-color-changed')]
    public function colorChanged() {
        $this->updateData(['color' => $this->color]);
    }

    public function updatedBold() {
        $this->updateData(['bold' => $this->bold]);
    }
}
