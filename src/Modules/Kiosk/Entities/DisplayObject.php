<?php

namespace Modules\Kiosk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Kiosk\Exceptions\PluginNotFoundException;
use Modules\Kiosk\KioskPluginManager\KioskPluginManager;

class DisplayObject extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Kiosk\Database\factories\DisplayObjectFactory::new();
    }

    public function getPlugin() {
        try {
            $plugin = KioskPluginManager::find($this->plugin_slug);
            return $plugin;
        }
        catch(PluginNotFoundException $e) {
            return null;
        }
    }
}
