<?php
namespace App\Components\DisplayBuilder;

use App\Models\DisplayObject;

interface ViewInterface {

    public function mount(DisplayObject $object);
    public function render();


}
