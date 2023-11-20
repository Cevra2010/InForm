<?php
namespace App\Components\DisplayEventManager\Facades;

use Illuminate\Support\Facades\Facade;

class DisplayEvent extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'display-event';
    }
}
