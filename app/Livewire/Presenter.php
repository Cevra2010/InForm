<?php

namespace App\Livewire;

use App\Components\DisplayEventManager\Facades\DisplayEvent;
use App\Models\Display;
use App\Models\DisplayObject;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Presenter extends Component
{

    public $display;

    public $runningEventId = null;

    public $listeners = [
        'calculate-screen-size-result' => 'calculateScreenSize',
    ];

    public $firstRun = true;

    public function mount(Display $display) {
        $this->display = $display;
    }

    public function render()
    {
        // Skipping Event-Managerment in initialisation
        if(!$this->firstRun) {
            $openEvents = DisplayEvent::openEvents($this->display->id);

            if (!$this->runningEventId && $openEvents->count()) {
                $this->runEvent($openEvents->last());
            }
        }
        else {
            $this->firstRun = false;
        }

        $this->display->last_action = Carbon::now();
        $this->display->save();

        $displayObjects = DisplayObject::where('display_id',$this->display->id)->get();

        return view('livewire.presenter',[
            'displayObjects' => $displayObjects,
        ]);
    }

    public function runEvent($event) {
        $this->runningEventId = $event->id;

        switch($event->event_name) {
            case "calculate-screen-size":
                $this->dispatch('calculate-screen-size',[$event->id]);
        }
    }

    #[On('calculate-screen-size-result')]
    public function calculateScreenSize($eventid,$width,$height) {
        $event = \App\Models\DisplayEvent::where('id',$eventid)->firstOrFail();
        $this->display->width = $width;
        $this->display->height = $height;
        $this->display->save();
        DisplayEvent::finish($event);
        $this->runningEventId = null;
    }
}
