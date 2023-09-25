<?php
namespace App\DisplayBuilder;

use App\Models\DisplayObject;

interface BuilderInterface {

    public function mount(DisplayObject $object);
    public function render();


}
