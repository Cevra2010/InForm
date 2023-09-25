<?php

namespace App\Livewire\Backend\Display;

use App\Models\Display;
use Carbon\Carbon;
use Livewire\Component;

class OnlineState extends Component
{

    public $display;
    public $online = false;

    public function mount(Display $display) {
        $this->display = $display;
    }
    public function render()
    {
        $this->display->fresh();
        if(Carbon::now()->diffInSeconds($this->display->last_action) > 5) {
            $this->online = false;
        }
        else {
            $this->online = true;
        }
        return view('livewire.backend.display.online-state');
    }
}
