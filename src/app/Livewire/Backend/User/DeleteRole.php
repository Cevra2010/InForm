<?php

namespace App\Livewire\Backend\User;

use Carbon\Carbon;
use Cis\CisAccess\Models\Role;
use Livewire\Component;

class DeleteRole extends Component
{

    public $role;
    public $usersInRole;
    public $usersInRoleOnly;

    public $roles;

    public $newGroup = null;

    public $deleteKey;
    public $givenKey = null;

    public function mount(Role $role) {
        $this->role = $role;
        $this->roles = Role::all();
        $this->newGroup = $this->roles->first()->id;
        $this->deleteKey = strtoupper(auth()->user()->username."-".$this->role->name."-".Carbon::now()->year);
    }

    public function render()
    {
        $this->usersInRole = $this->role->users;
        $this->usersInRoleOnly = collect();

        foreach($this->usersInRole as $user) {
            if($user->roles()->count() <= 1) {
                $this->usersInRoleOnly->add($user);
            }
        }
        return view('livewire.backend.user.delete-role');
    }

    public function submit() {
        $newRole = Role::find($this->newGroup);
        foreach($this->role->users as $user) {
            $user->roles()->detach($this->role);
            $user->roles()->sync($newRole);
        }
        return redirect()->route("backend.user.roles.show",$this->role);
    }

    public function submitDelete() {
        if($this->givenKey == $this->deleteKey) {
            $this->role->delete();
        }
        else {
            $this->addError('code','Sie haben nicht den korrekten Sicherheitscode angegeben.');
            return false;
        }

        session()->flash("success",__('form.success'));
        return redirect()->route("backend.user.roles.list");
    }
}
