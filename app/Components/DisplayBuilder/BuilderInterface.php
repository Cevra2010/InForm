<?php
namespace App\Components\DisplayBuilder;

use App\Models\DisplayObject;

interface BuilderInterface {

    public function mount(DisplayObject $object);
    public function render();


}
