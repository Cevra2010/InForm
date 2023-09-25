<?php
namespace App\ModuleManager\Facades;

use Illuminate\Support\Facades\Facade;

class ModuleFacade  extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'inform-module';
    }
}
