<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InformPanel extends Component
{

    public $headline;
    public $icon; 
    /**
     * Create a new component instance.
     */
    public function __construct($headline = null, $icon = null)
    {
        $this->headline = $headline;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inform-panel');
    }
}
