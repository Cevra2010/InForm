<?php
namespace App\Components\ColorManager;

use App\Models\DisplayObject;
use Livewire\Attributes\On;

trait HasColors {

    public function getColorStyle($colorName,$replaceString = false) {
        if($this->colorExists($colorName)) {
            $colorData = $this->getColor($colorName);
            if($colorData['mode'] == "hex") {
                if(!$replaceString) {
                    return $colorData['hex'];
                }
                else {
                    return str_replace("{hex}",$colorData['hex'],$replaceString);
                }
            }
        }
        return null;
    }

    public function getColorClass($colorName,$prefix = 'bg') {
        if($this->colorExists($colorName)) {
            $colorData = $this->getColor($colorName);
            if($colorData['mode'] == "tailwind") {
                return $prefix."-".$colorData['name']."-".$colorData['strength'];
            }
        }
        return null;
    }

    public function colorExists($colorName) {
        if(isset($this->displayObject->data['colors'][$colorName])) {
            return true;
        }
        return false;
    }

    public function getColor($colorName) {
        try {
            if (!isset($this->displayObject->data['colors'][$colorName])) {
                throw new ColorNotFoundException("Color '" . $colorName . "' not defined");
            }
        }
        catch(ColorNotFoundException $e) {
            abort(403,'Colorpicker: Color "'.$colorName.'" not found!');
        }
        return array_merge(['color-name' => $colorName],$this->displayObject->data['colors'][$colorName]);
    }

    #[On('color-updated')]
    public function colorHasUpdatedEvent($eventStuff) {
        if(isset($this->displayObject->data['colors'][$eventStuff['color-name']])) {
            $array = $this->displayObject->data;
            $array['colors'][$eventStuff['color-name']] = [
                'mode' => $eventStuff['mode'],
                'name' => $eventStuff['name'],
                'hex' => $eventStuff['hex'],
                'strength' => $eventStuff['strength']
            ];

            $this->displayObject->data = array_merge($this->displayObject->data,$array);
            $this->displayObject->save();
            $this->updateData([]);

        }
    }

    #[On('hex-color-updated')]
    public function hexColorUpdated() {

    }
}
