<?php

namespace App\Livewire\Backend\User;

use Cis\CisAccess\Models\Area;
use Cis\CisAccess\Models\Role;
use Livewire\Component;

class AreaToggle extends Component
{

    public $area;
    public $role;
    public $status = false;

    public function mount(Area $area,Role $role) {
        $this->area = $area;
        $this->role = $role;
        if($this->role->areas()->find($area)) {
            $this->status = true;
        }
    }

    public function render()
    {
        return view('livewire.backend.user.area-toggle');
    }

    public function setActive(Role $role, Area $area) {
        $this->role->areas()->attach($area);
        $this->status = true;
    }

    public function setInactive(Role $role, Area $area) {
        $this->role->areas()->detach($area);
        $this->status = false;
    }

}
