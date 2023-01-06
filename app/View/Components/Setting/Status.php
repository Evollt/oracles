<?php

namespace App\View\Components\Setting;

use App\Models\Setting\Color;
use Illuminate\View\Component;

class Status extends Component
{
    public $color;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color, $title)
    {
        $this->title = $title;

        if ($color instanceof Color){
            $this->color = $color;
        } elseif (is_numeric($color)){
            $this->color = Color::find($color);
        } elseif (is_string($color)){
            $this->color = Color::where('slug', '=', $color)->first();
        }

        if (null === $this->color){
            $this->color = new Color([
                'text' => '#258A4F',
                'background' => '#91E5B6',
            ]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.setting.status');
    }
}
