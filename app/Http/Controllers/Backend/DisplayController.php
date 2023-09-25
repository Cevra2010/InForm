<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Display;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function list() {
        $displays = Display::all();
        return view("backend.display.list",[
            'displays' => $displays,
        ]);
    }

    public function edit(Display $display) {
        return view("backend.display.edit",[
            'display' => $display
        ]);
    }

    public function displayBuilder(Display $display) {

        // TODO: Prüfen ob die Display width und height gesetzt sind bevor Builder geöffnet werden kann

        return view("backend.display.builder",[
            'display' => $display,
        ]);
    }
}
