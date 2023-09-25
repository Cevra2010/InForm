<?php
namespace Modules\InformText\Livewire;

use App\Components\ColorManager\HasColors;
use App\Components\DisplayBuilder\View;
use App\Components\DisplayBuilder\ViewInterface;
use App\Models\DisplayObject;

class TextView extends View implements ViewInterface {

    use HasColors;
    public function mount(DisplayObject $object)
    {
        parent::mount($object);
    }

    public function render()
    {
        return view("informtext::livewire.view");
    }
}
