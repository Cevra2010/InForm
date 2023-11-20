<?php
namespace App\Components\IconPicker;

use Illuminate\Support\Facades\View;
use Livewire\Livewire;

class IconPicker {


    public static function boot() {
        View::addNamespace("iconpicker",__DIR__.'/view');
        Livewire::component('inform-iconpicker',IconPickerComponent::class);
    }

}
