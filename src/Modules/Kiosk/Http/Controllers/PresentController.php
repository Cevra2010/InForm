<?php

namespace Modules\Kiosk\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Kiosk\Entities\Display;

class PresentController extends Controller
{
    public function present($display) {
        $display = Display::where('hash',$display)->firstOrFail();
        return view("kiosk::presenter.present",[
            'display' => $display,
        ]);
    }
}
