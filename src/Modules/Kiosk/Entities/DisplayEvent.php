<?php

namespace Modules\Kiosk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisplayEvent extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function display() {
        $this->hasOne(Display::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Kiosk\Database\factories\DisplayEventFactory::new();
    }
}
