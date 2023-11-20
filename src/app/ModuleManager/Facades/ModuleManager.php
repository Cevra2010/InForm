<?php
namespace App\ModuleManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void register(string $moduleLowerName, bool $touchable, $moduleBuilderComponent, $moduleBuilderViewComponent, $moduleViewComponent, array $parameters)
 */

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
