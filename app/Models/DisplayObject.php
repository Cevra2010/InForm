<?php

namespace App\Models;

use App\ModuleManager\ModuleManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisplayObject extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
    ];

    public function getModule() {
        return ModuleManager::getModule($this->type);
    }

    public function display() {
        return $this->hasOne(Display::class,'id','display_id');
    }
}
