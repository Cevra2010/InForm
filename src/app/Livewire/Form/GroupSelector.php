<?php

namespace App\Livewire\Form;

use App\Models\Group;
use Exception;
use Livewire\Component;

class GroupSelector extends Component
{

    public $target;
    public $groups;
    public $selectedGroups;
    public $firstActionName;

    public function mount($target,$targetId,$firstActionName = 'Alle') {
        $this->target = $target;
        $this->groups = Group::all();
        $this->selectedGroups = collect();
        $this->firstActionName = $firstActionName;

        if(!$targetConfigElement = config("group-selector.".$target)) {
            throw new Exception('Target Group-Selector not found: '.$target);
        }

        $targetInstance = $targetConfigElement['class']::find($targetId);
        $method = $targetConfigElement['method'];

        if(!$groups = $targetInstance->$method) {
            $this->selectedGroups = collect();
        }
        else {
            $this->selectedGroups = $groups;
        }

        
    }

    public function render()
    {
        return view('livewire.form.group-selector');
    }

    public function toggleGroup(Group $group) {
        if($searchGroup = $this->selectedGroups->where('id',$group->id)->first()) {
            foreach($this->selectedGroups->all() as $key => $value) {
                if($value->id == $group->id) {
                    $this->selectedGroups->forget($key);
                } 
            }
        }
        else {
            $this->selectedGroups->add($group);
        }
    }

    public function setAll() {
        $this->selectedGroups = collect();
    }
}
