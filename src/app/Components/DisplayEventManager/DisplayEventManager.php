<?php

namespace App\Components\DisplayEventManager;

use App\Models\Display;
use App\Models\DisplayEvent;
use Carbon\Carbon;

class DisplayEventManager {

    protected $event;

    public function fire($displayId,$eventName,$parameters = null) {
        $this->event = new DisplayEvent();
        $this->event->display = $displayId;
        $this->event->event_name = $eventName;

        if($parameters) {
            $this->event->event_parameter = json_encode($parameters);
        }
        else {
            $this->event->event_parameter = null;
        }

        $this->event->save();
        return $this->event->id;
    }

    public function isFinished($eventId) {
        if(!$event = DisplayEvent::find($eventId)) {
            return false;
        }
        if($event->runed_at) {
            return true;
        }
        return false;
    }

    public function openEvents($displayId) {
        return DisplayEvent::where('display',$displayId)->where('runed_at',null)->get();
    }

    public function finish($event) {
        $event->runed_at = Carbon::now();
        $event->save();
    }

}
