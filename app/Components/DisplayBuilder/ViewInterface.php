<?php
namespace App\DisplayBuilder;

use App\Models\DisplayObject;

interface ViewInterface {

    public function mount(DisplayObject $object);
    public function render();


}
