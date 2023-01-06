<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class Footer extends Component
{
    public $copyright;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->copyright = env('APP_NAME') . ' ' . Carbon::now()->format('Y');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
