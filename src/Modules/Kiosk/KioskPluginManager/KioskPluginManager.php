<?php
namespace Modules\Kiosk\KioskPluginManager;

use Exception;
use Modules\Kiosk\Exceptions\PluginNotFoundException;

class KioskPluginManager {
    
    protected static $plugins;

    public static function init() {
        self::$plugins = collect();
    }

    public static function find($pluginSlug) {
        if($plugin = self::$plugins->where('slug',$pluginSlug)->first()) {
            return $plugin;
        }
        throw new PluginNotFoundException($pluginSlug);
    }

    public static function getPlugins() {
        return self::$plugins;
    }

    public static function registerPlugin($pluginSlug) {
        $newPlugin = new KioskPlugin($pluginSlug);
        self::$plugins->add($newPlugin);
        return $newPlugin;
    }

}