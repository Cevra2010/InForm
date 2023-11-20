<?php

namespace Modules\Kiosk\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Kiosk\Entities\Display;

class DisplayController extends Controller
{
    public function list() {
        $displays = Display::all();
        return view("kiosk::display.list",[
            'displays' => $displays,
        ]);
    }

    public function edit(Display $display) {
        return view("kiosk::display.edit",[
            'display' => $display
        ]);
    }

    public function displayBuilder(Display $display) {
        // TODO: Prüfen ob die Display width und height gesetzt sind bevor Builder geöffnet werden kann

        
        return view("kiosk::builder.display",[
            'display' => $display,
        ]);
    }
}
