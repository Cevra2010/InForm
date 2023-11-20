<?php
namespace Modules\Newsfeed\Livewire;

use App\Components\DisplayBuilder\Builder as DisplayBuilderBuilder;

class Builder extends DisplayBuilderBuilder {
    public function render() {
        return view("newsfeed::livewire.builder");
    }
}