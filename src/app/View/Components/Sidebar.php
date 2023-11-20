<?php

namespace App\View\Components;

use App\Components\SidebarManager\SidebarManager;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    private function addObject($object) {
        $this->sidebarObjects->add($object);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar',[
            'sidebar' => SidebarManager::getSidebar(),
        ]);
    }
}
