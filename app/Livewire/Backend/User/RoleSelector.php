<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Cis\CisAccess\Models\Role;
use Livewire\Component;

/***********************************************************
|
|   Role Selector - Livewire Component
|
|   Set the access to a User-Role for the given user
|
 ***********************************************************/
class RoleSelector extends Component
{

    /**
     * @var User
     */
    public $user;
    /**
     * @var Role
     */
    public $roles;

    /**
     * mounting the components with given user
     * @param User $user
     * @return void
     */
    public function mount(User $user) : void
    {
        $this->user = $user;
        $this->roles = Role::all();
    }


    /**
     * changes the role active/inactive
     *
     * @param Role $role
     * @return void
     */
    public function changeRole(Role $role) : void
    {
        if ($this->user->roles()->find($role)) {
            $this->user->roles()->detach($role);
        } else {
            $this->user->roles()->attach($role);
        }
    }

    /**
     * rendering the livewire component
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('livewire.backend.user.role-selector');
    }
}
