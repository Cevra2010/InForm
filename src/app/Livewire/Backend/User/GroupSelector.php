<?php

namespace App\Livewire\Backend\User;

use App\Models\Group;
use App\Models\User;
use Auth;
use Livewire\Component;

class GroupSelector extends Component
{

    public $user;
    public $groups;

    public function mount(User $user) {
        $this->user = $user;
        $this->groups = Group::all();
    }

    public function changeGroup(Group $group) : void
    {
        if ($this->user->groups()->find($group)) {
            $this->user->groups()->detach($group);
        } else {
            $this->user->groups()->attach($group);
        }
    }

    public function render()
    {
        return view('livewire.backend.user.group-selector');
    }
}
