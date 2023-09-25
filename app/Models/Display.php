<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_action' => 'datetime',
    ];

    public function displayObjects() {
        return $this->hasMany(DisplayObject::class,'display_id');
    }
}
