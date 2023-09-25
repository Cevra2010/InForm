<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'color',
    ];

    public function getBadge() {
        preg_match('/-([0-9]*)/',$this->color,$matchesColor);
        $colorNum = (isset($matchesColor[1]) ? $matchesColor[1] : null);


        if(isset($colorNum) && $colorNum >= 500) {
            $textColor = 'text-slate-50';
        }
        else {
            $textColor = 'text-slate-900';
        }

        if($this->icon) {
            $icon = '<i class="fa fa-'.$this->icon.'"></i>';
        }
        else {
            $icon = null;
        }

        return '<span class="rounded px-2 py-1 text-xs bg-'.$this->color.' '.$textColor.'">'.$icon.' '.$this->name.'</span>';
    }
}
