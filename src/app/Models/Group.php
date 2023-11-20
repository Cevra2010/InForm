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

    public function getColorStrength() {
        preg_match('/-([0-9]*)/',$this->color,$matchesColor);
       return (isset($matchesColor[1]) ? $matchesColor[1] : null);
    }

    public function getBadge() {
        return '<span class="rounded px-2 py-1 text-xs '.$this->getBadgeTextColorAsCssClass().'" style="background-color: '.$this->color.';"><i class="fa fa-'.$this->icon.'"></i> '.$this->name.'</span>';
    }

    public function getBadgeTextColorAsCssClass() {
        $hsl = RGBToHSL(HTMLToRGB($this->color));
        if($hsl->lightness > 200) {
            $textColor = 'text-slate-600';
        }
        else {
            $textColor = 'text-slate-50';
        }
        return $textColor;
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function hasUser(User|null $user = null) {
        if(!$user) {
            $user = auth()->user();
        }

        if($this->users()->where('user_id',$user->id)->count()) {
            return true;
        }
        return false;

    }
}
