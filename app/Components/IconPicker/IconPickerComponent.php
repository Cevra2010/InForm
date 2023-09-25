<?php
namespace App\Components\IconPicker;

use Livewire\Component;

class IconPickerComponent extends Component {


    public $icon;

    public function mount($icon) {
        $this->icon = $icon;
    }

    public function render() {
        return view("iconpicker::pick");
    }

    public function setIcon($iconName) {
        $this->icon = $iconName;
    }

}