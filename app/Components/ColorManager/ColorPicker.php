<?php
namespace App\Components\ColorManager;

use App\Models\DisplayObject;
use Livewire\Component;

class ColorPicker extends Component {

    public $colorName;
    public $mode;
    public $hex;

    public $name;
    public $strenght;
    public $formUsage = false;

    public function mount($color,$inputName = null) {

        // Standard farbe setzen
        if(!$color) {
            $color = config('colors.default_color');
        }

        if(!is_array($color)) {
            preg_match("/([a-zA-z]*)-([0-9]*)/",$color,$colorMatches);
            $color = [
                'mode' => 'tailwind',
                'strength' => $colorMatches[2],
                'name' => $colorMatches[1],
                'hex' => null,
                'colorName' => $inputName,
            ];
        }


        if($inputName) {
            $this->formUsage = true;
            $this->colorName = $inputName;
        }
        else {
            $this->mode = $color['mode'];
            $this->hex = $color['hex'];
            $this->colorName = $color['color-name'];
        }

        $this->name = $color['name'];
        $this->strenght = $color['strength'];
    
    }

    public function render() {
        return view("colorpicker::colorpicker");
    }

    public function updated() {
        $this->dispatch('color-updated',[
            'color-name' => $this->colorName,
            'mode' => $this->mode,
            'hex' => $this->hex,
            'name' => $this->name,
            'strength' => $this->strenght,
        ]);
    }

}
