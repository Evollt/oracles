<?php

namespace App\View\Components\Navigation;

use Illuminate\View\Component;

class SideNavigation extends Component
{
    /** @var array */
    public $items;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->items = config('menu');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navigation.side-navigation');
    }
}
