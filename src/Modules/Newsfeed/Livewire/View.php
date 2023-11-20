<?php
namespace Modules\Newsfeed\Livewire;

use App\Components\DisplayBuilder\Builder as DisplayBuilderBuilder;

class View extends DisplayBuilderBuilder {
    public function render() {
        return view("newsfeed::livewire.view");
    }
}