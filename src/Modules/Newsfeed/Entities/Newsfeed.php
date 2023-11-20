<?php

namespace Modules\Newsfeed\Entities;

use App\Models\Group;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newsfeed extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
    ];

    public function groupsRead() {
        return $this->belongsToMany(Group::class,'group_newsfeed_read');
    }

    public function groupsWrite() {
        return $this->belongsToMany(Group::class,'group_newsfeed_write');
    }

    public function groupsPublish() {
        return $this->belongsToMany(Group::class,'group_newsfeed_publish');
    }
    
    protected static function newFactory()
    {
        return \Modules\Newsfeed\Database\factories\NewsfeedFactory::new();
    }

    public function canWrite(User $user = null) {
        if(!$user) {
            $user = Auth::user();
        }

        foreach($this->groupsWrite as $group) {
            if($group->hasUser($user)) {
                return true;
            }
            return false;
        }
    }

    public function canRead(User $user = null) {
        if(!$user) {
            $user = Auth::user();
        }

        foreach($this->groupsRead as $group) {
            if($group->hasUser($user)) {
                return true;
            }
            return false;
        }
    }

    public function canPublish(User $user = null) {
        if(!$user) {
            $user = Auth::user();
        }

        foreach($this->groupsPublish as $group) {
            if($group->hasUser($user)) {
                return true;
            }
            return false;
        }
    }

    public function hasAccess(User $user = null) {
        if(!$user) {
            $user = Auth::user();
        }

        foreach($this->groupsWrite as $group) {
            $group->hasUser($user);
        }
    }
}
