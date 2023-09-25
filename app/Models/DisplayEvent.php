<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisplayEvent extends Model
{
    use HasFactory;

    public function display() {
        $this->hasOne(Display::class);
    }
}
