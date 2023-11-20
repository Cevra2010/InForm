<?php

namespace App\Livewire\Backend\Display\DisplayBuilder;

use App\Models\Display;
use App\Models\DisplayObject;
use App\ModuleManager\Module;
use App\ModuleManager\ModuleManager;
use Livewire\Component;
use Livewire\Attributes\On;

class Builder extends Component
{

    public $loadingState = true;

    public $display;
    public $screenWidth = 0;
    public $screenHeight = 0;
    public $scratchWidth = 0;
    public $scratchHeight = 0;
    public $init = false;
    public $toolbarWidth = 320;
    public $borderOffsetOfScreen = 30;
    public $displayOffset = 30;
    public $toolbarItems;
    public $moduleObjectEdit = null;


    public function mount(Display $display) {
        $this->display = $display;

        $this->toolbarItems = collect();

        foreach(ModuleManager::getAllModules() as $module) {
            $item = new \stdClass();
            $item->name = $module->getName();
            $this->toolbarItems->add($item);
        }

    }

    public function render()
    {
        if($this->init) {
            $maxWidth = $this->screenWidth - $this->toolbarWidth - $this->displayOffset;
            $maxHeight = $this->screenHeight - $this->displayOffset;

            // Bildschirm ist breiter als höher
            if($this->display->width > $this->display->height) {
                $this->scratchWidth = $maxWidth;
                $factor = round(($maxWidth / $this->display->width) * 100);
                $this->scratchHeight = round($this->display->height / 100 * $factor);
            }
            //Bildschirm ist höher als breiter
            else {
                $this->scratchHeight = $maxHeight;
                $factor = round(($maxHeight / $this->display->height) * 100);
                $this->scratchWidth = round($this->display->width / 100 * $factor);
            }
        }

        $displayObjects = DisplayObject::where('display_id',$this->display->id)->get();

        return view('livewire.backend.display.display-builder.builder',[
            'displayObjects' => $displayObjects,
        ]);
    }

    #[On('init-builder')]
    public function initBuilder($width,$height) {
        $this->screenWidth = $width;
        $this->screenHeight = $height;
        $this->loadingState = false;
        $this->init = true;
    }

    #[On('add-module')]
    public function addModule($name,$left,$top) {

        $module = ModuleManager::getModule($name);
        $data = $module->getModuleInitData();

        if(!$highestZObject = $this->display->displayObjects()->orderBy('zindex','desc')->first()) {
            $newZIndex = 1;
        }
        else {
            $newZIndex = $highestZObject->zindex + 1;
        }


        $displayObject = new DisplayObject();
        $displayObject->type = $name;
        $displayObject->pos_x = $this->realLeft($left);
        $displayObject->pos_y = $this->realTop($top);
        $displayObject->width = 100;
        $displayObject->height = 100;
        $displayObject->display_id = $this->display->id;
        $displayObject->data = $data;
        $displayObject->zindex = $newZIndex;
        $displayObject->save();
    }

    #[On('update-module-position')]
    public function updateModulePosition(DisplayObject $object,$left,$top) {
        $object->pos_x = $this->realLeft($left);
        $object->pos_y = $this->realTop($top);
        $object->save();
    }

    #[On('update-module-size')]
    public function updateModuleSize(DisplayObject $object,$width,$height) {
        $width = str_replace("px","",$width);
        $height = str_replace("px","",$height);
        $object->width = $this->realWidth($width);
        $object->height = $this->realHeight($height);
        $object->save();
        $this->dispatch("object-updated");
    }

    private function realTop($top) {
        return round($top / $this->scratchHeight * $this->display->height);
    }

    private function realLeft($left) {
        return round($left / $this->scratchWidth * $this->display->width);
    }

    private function realWidth($width) {
        return round($width / $this->scratchWidth * $this->display->width);
    }

    private function realHeight($height) {
        return round($height / $this->scratchHeight * $this->display->height);
    }
    #[On('open-module-settings')]
    public function openModuleSettings(DisplayObject $object) {
        $this->moduleObjectEdit = $object;
    }

    #[On('object-updated')]
    public function objectUpdated() {
        if($this->moduleObjectEdit) {
            $this->moduleObjectEdit->refresh();
        }
    }

    public function closeModuleSettings() {
        $this->moduleObjectEdit = null;
    }

    public function zDown() {
        $zIndexNow = $this->moduleObjectEdit->zindex;
        if($zIndexNow > 1) {
            $nextObject = DisplayObject::where('display_id',$this->display->id)->where('zindex','<',$zIndexNow)->orderBy('zindex','desc')->first();
            $zIndexNew = $nextObject->zindex;

            $nextObject->zindex = $zIndexNow;
            $nextObject->save();

            $this->moduleObjectEdit->zindex = $zIndexNew;
            $this->moduleObjectEdit->save();
        }
    }

    public function zDownest() {
        DisplayObject::where('display_id',$this->display->id)->where('zindex','<',$this->moduleObjectEdit->zindex)->orderBy('zindex','desc')->increment('zindex',1);
        $this->moduleObjectEdit->zindex = 1;
        $this->moduleObjectEdit->save();
    }

    public function zUp() {
        if($upper = DisplayObject::where('display_id',$this->display->id)->where('zindex','>',$this->moduleObjectEdit->zindex)->first()) {
            $zIndexNow = $this->moduleObjectEdit->zindex;
            $zIndexNew = $upper->zindex;

            $this->moduleObjectEdit->zindex = $zIndexNew;
            $this->moduleObjectEdit->save();

            $upper->zindex = $zIndexNow;
            $upper->save();
        }
    }

    public function zUppest() {
        $highest = DisplayObject::where('display_id',$this->display->id)->orderBy('zindex','desc')->first();
        $highestIndex = $highest->zindex;
        DisplayObject::where('display_id',$this->display->id)->where('zindex','>',$this->moduleObjectEdit->zindex)->orderBy('zindex','desc')->decrement('zindex',1);
        $this->moduleObjectEdit->zindex = $highestIndex;
        $this->moduleObjectEdit->save();
    }

    public function deleteObject() {
        if($this->moduleObjectEdit) {
            $object = $this->moduleObjectEdit;
            $this->moduleObjectEdit = null;
            $object->delete();
        }
        $this->objectUpdated();
    }
}
