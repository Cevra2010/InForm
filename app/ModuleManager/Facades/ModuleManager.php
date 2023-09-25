<?php
namespace App\ModuleManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static register()
 */
class ModuleManager  extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'inform-module';
    }
}
