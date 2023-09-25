<?php

namespace App\Http\Controllers;

use App\Models\Display;
use Illuminate\Http\Request;

class PresentController extends Controller
{
    public function present($display) {
        $display = Display::where('hash',$display)->firstOrFail();
        return view("present.present",[
            'display' => $display,
        ]);
    }
}
