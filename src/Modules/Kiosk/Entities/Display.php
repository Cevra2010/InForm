<?php

namespace Modules\Kiosk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Display extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_action' => 'datetime',
    ];

    public function displayObjects() {
        return $this->hasMany(DisplayObject::class,'display_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Kiosk\Database\factories\DisplayFactory::new();
    }
}
