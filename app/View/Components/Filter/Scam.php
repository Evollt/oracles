<?php

namespace App\View\Components\Filter;

use App\Models\Bot\ScamCategory;
use App\Models\Bot\ScamStatus;
use Illuminate\View\Component;

class Scam extends Component
{
    public $statuses;
    public $categories;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->statuses = ScamStatus::get()->pluck('name', 'id')->toArray() + ['' => ''];
        $this->categories = ScamCategory::get()->pluck('name', 'id')->toArray() + ['' => ''];
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filter.scam');
    }
}
