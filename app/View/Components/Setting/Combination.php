<?php

namespace App\View\Components\Setting;

use App\Models\Setting\Color;
use Illuminate\View\Component;

class Combination extends Component
{
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color)
    {
        if ($color instanceof Color){
            $this->color = $color;
        } elseif (is_numeric($color)){
            $this->color = Color::find($color);
        } elseif (is_string($color)){
            $this->color = Color::where('slug', '=', $color)->first();
        }

        if (null === $this->color){
            $this->color = new Color([
                'text' => '#E96464',
                'background' => '#FAD0D0',
                'border' => '#F0E2E2',
                'name' => 'Color deleted',
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
        return view('components.setting.combination');
    }
}
