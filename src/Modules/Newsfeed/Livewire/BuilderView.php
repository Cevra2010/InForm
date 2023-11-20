<?php
namespace Modules\Newsfeed\Livewire;

use App\Components\DisplayBuilder\View;

class BuilderView extends View {
    
    public function render() {
        return view("newsfeed::livewire.builderView");
    }

}