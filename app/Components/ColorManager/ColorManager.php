<?php
namespace App\Components\ColorManager;

use Illuminate\Support\Facades\View;

class ColorManager {

    const COLOR_PARAMETERS = [
        'mode' => 'tailwind',
        'name' => 'slate',
        'strength' => '300',
        'hex' => '#cecece',
        ];
    public static function generateInitData($colorName) {

        $colorArray = [];

        if(is_array($colorName)){
            foreach($colorName as $color) {
                $colorArray[$color] = self::COLOR_PARAMETERS;
            }
        }
        else {
            $colorArray[$colorName] = self::COLOR_PARAMETERS;
        }

        return $colorArray;
    }

    public static function registerViewNamespace() {
        View::addNamespace("colorpicker",__DIR__.'/view');
    }

}
