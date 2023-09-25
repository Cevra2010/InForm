<?php
namespace App\Components\DisplayEventManager;

use Illuminate\Support\Facades\Facade;

class DisplayEvent extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'display-event';
    }
}
