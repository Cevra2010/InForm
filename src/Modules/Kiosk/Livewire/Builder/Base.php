<?php
namespace Modules\Kiosk\Livewire\Builder;

use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Kiosk\Entities\Display;
use Modules\Kiosk\Entities\DisplayObject;
use Modules\Kiosk\KioskPluginManager\KioskPluginManager;

class Base extends Component {

    public bool $loading = true;
    public bool $addPlugin = false;

    public Display $display;

    public int $displayWidth;
    public int $displayHeight;

    public int $screenWidth;
    public int  $screenHeight;

    public int $scratchWidth;
    public int $scratchHeight;

    public int $zoomFactor = 100;
    public bool $grid = false;
    public $deletedObjects = [];

    public $selectedObjectId = null;

    public function mount(Display $display) {
        $this->display = $display;
        $this->displayWidth = $display->width;
        $this->displayHeight = $display->height;
        //$this->loadDisplayObjects();
    }

    public function render() {
        return view("kiosk::livewire.builder.base",[
            'displayObjects' => DisplayObject::where('display_id',$this->display->id)->get(),
        ]);
    }

    #[On('kiosk-init-builder')]
    public function initBuilder($width,$height) {
        $this->loading = false;
    }

    public function zoomIn() {
        $this->zoomFactor = $this->zoomFactor + 10;
        $this->dispatch('zoom-factor',$this->zoomFactor);
    }

    public function zoomOut() {
        $this->zoomFactor = $this->zoomFactor - 10;
        $this->dispatch('zoom-factor',$this->zoomFactor);
    }

    public function resetZoom() {
        $this->zoomFactor = 100;
        $this->dispatch('zoom-factor',$this->zoomFactor);
    }

    #[On('display-object-moved')]
    public function objectMoved($object_id, $x, $y) {
        if($displayObject = DisplayObject::find($object_id)) {
            $displayObject->pos_x = $x / $this->zoomFactor * 100;
            $displayObject->pos_y = $y / $this->zoomFactor * 100;
            $displayObject->save();
            $this->skipRender();
        }
    }

    #[On('display-object-resized')]
    public function objectResized($object_id, $width, $height) {
        $displayObject = DisplayObject::find($object_id);
        $displayObject->width = $width / $this->zoomFactor * 100;
        $displayObject->height = $height / $this->zoomFactor * 100;
        $displayObject->save();
        $this->skipRender();
    }

    public function addPluginBySlug($pluginSlug) {
        $plugin = KioskPluginManager::find($pluginSlug);
        $newObject = new DisplayObject();
        $newObject->display_id = $this->display->id;
        $newObject->plugin_slug = $plugin->getSlug();
        $newObject->width = 200;
        $newObject->height = 200;
        $newObject->pos_x = $this->display->width / 2 - ($newObject->width / 2);
        $newObject->pos_y = $this->display->height / 2 - ($newObject->height / 2);
        $newObject->data = $plugin->getDefaultDataAsJson();
        $newObject->zindex = 1;
        $newObject->name = $pluginSlug;
        $newObject->save();
        $newObject->name = $pluginSlug."#".$newObject->id;
        $newObject->save();

        $this->addPlugin = false;
        $this->dispatch('plugin-added',['object_id' => $newObject->id]);
        return $this->redirect(route("kiosk::display.build",$this->display->id));
    }

    #[On('select-object')]
    public function objectSelected($id) {
        $this->selectedObjectId = $id;
        $this->skipRender();
    }

    #[On('selected-to-null')]
    public function selectedToNull() {
        $this->selectedObjectId = null;
    }

    #[On('delete-object')]
    public function onDisplayObjectDeleted($id) {
        $this->deletedObjects[] = $id;
        return $this->redirect(route("kiosk::display.build",$this->display->id));
    }
}