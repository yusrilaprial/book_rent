<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RentLogTable extends Component
{
    public $rentlogs;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($rentlogs)
    {
        $this->rentlogs = $rentlogs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rent-log-table');
    }
}
