<?php
namespace App\ModuleManager;

use Illuminate\Support\Collection;

class ModuleManager {

    public static Collection $modules;

    public static function boot() {
        self::$modules = collect();
    }

    public static function getAllModules() {
        return self::$modules;
    }

    public static function getModule($moduleName) {
        return self::$modules->where("moduleName",$moduleName)->first();
    }
}
