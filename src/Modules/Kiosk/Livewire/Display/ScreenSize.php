<?php

namespace Modules\Kiosk\Livewire\Display;

use App\Components\DisplayEventManager\Facades\DisplayEvent;
use Modules\Kiosk\Entities\Display;
use Livewire\Component;
use Modules\Kiosk\Entities\DisplayEvent as EntitiesDisplayEvent;

class ScreenSize extends Component
{
    public $display;
    public $event_id = null;
    public $started = false;

    public function mount(Display $display){
        $this->display = $display;
    }
    public function render()
    {

        if($event = EntitiesDisplayEvent::where('event_name','calculate-screen-size')->where('display',$this->display->id)->where('runed_at',null)->first()){
            $this->started = true;
            $this->event_id = $event->id;
        }

        if($this->started)
        {
            if(DisplayEvent::isFinished($this->event_id)){
                $this->started = false;
                $this->display->fresh();
            }
        }
        return view('kiosk::livewire.display.screen-size');
    }

    public function calculate() {
        $this->started = true;
        $this->event_id = DisplayEvent::fire($this->display->id,'calculate-screen-size');
    }
}
