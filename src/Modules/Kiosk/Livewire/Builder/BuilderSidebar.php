<?php
namespace Modules\Kiosk\Livewire\Builder;

use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Kiosk\Entities\Display;
use Modules\Kiosk\Entities\DisplayObject;

class BuilderSidebar extends Component {


    public $display;
    public $selectedObjectId = null;
    public $deletedObjects = [];
    public $selectedObjectName = null;

    public function mount(Display $display) {
        $this->display = $display;
    }

    public function render() {
        return view("kiosk::livewire.builder.builder-sidebar",[
            'displayObjects' => DisplayObject::where('display_id',$this->display->id)->get(),
            'selectedObject' => ($this->selectedObjectId) ? DisplayObject::find($this->selectedObjectId) : null,
        ]);
    }

    public function setSelectedObjectToNull() {
        $this->selectedObjectId = null;
        $this->selectedObjectName = null;
        $this->dispatch('selected-to-null');
    }

    #[On('builder-object-selected')]
    public function builderObjectSelectedEvent($object_id) {
        $selectedObject = DisplayObject::find($object_id);
        $this->selectedObjectId = $selectedObject->id;
        $this->selectedObjectName = $selectedObject->name;
        $this->dispatch('select-object',$this->selectedObjectId);
    }

    public function updatedSelectedObjectName() {
        $object = DisplayObject::find($this->selectedObjectId);
        $object->name = $this->selectedObjectName;
        $object->save();
    }

    #[On('plugin-added')]
    public function pluginAdded($array) {
        $this->builderObjectSelectedEvent($array['object_id']);
    }

    public function deleteObject() {
        $deleteObjectId = $this->selectedObjectId;
        DisplayObject::find($deleteObjectId)->delete();
        $this->selectedObjectId = null;
        $this->dispatch("delete-object",$deleteObjectId);
        //$this->deletedObjects[$deleteObjectId] = true;
        return true;
    }

}