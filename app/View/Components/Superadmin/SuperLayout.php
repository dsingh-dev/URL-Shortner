<?php

namespace App\View\Components\Superadmin;

use Illuminate\View\Component;
use Illuminate\View\View;

class SuperLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.'.SUPER.'.super');
    }
}
