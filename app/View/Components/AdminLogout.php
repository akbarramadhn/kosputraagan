<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminLogout extends Component
{
    public $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($icon = null)
    {
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.admin-logout');
    }
}