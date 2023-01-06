<?php

namespace Database\Seeders\Deploy;

use App\Models\Setting\Color;
use Illuminate\Database\Seeder;

class Colors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'Primary',
                'border' => '#dae4f4',
                'background' => '#dae4f4',
                'text' => '#000',
            ],
            [
                'name' => 'Warning',
                'border' => '#EFE6CF',
                'background' => '#FCE19D',
                'text' => '#F8A303',
            ],
            [
                'name' => 'Danger',
                'border' => '#F0E2E2',
                'background' => '#FAD0D0',
                'text' => '#E96464',
            ],
            [
                'name' => 'Success',
                'border' => '#B6DAD9',
                'background' => '#91E5B6',
                'text' => '#258A4F',
            ],
            [
                'name' => 'Info',
                'border' => '#84b0b5',
                'background' => '#1c98a6',
                'text' => '#05dff7',
            ],
            [
                'name' => 'Secondary',
                'border' => '#84b0b5',
                'background' => '#1c98a6',
                'text' => '#05dff7',
            ],
            [
                'name' => 'Red',
                'border' => '#ba4d43',
                'background' => '#9e291e',
                'text' => '#e81500',
            ],
            [
                'name' => 'Orange',
                'border' => '#c79d67',
                'background' => '#bf6e04',
                'text' => '#fc9003',
            ],
            [
                'name' => 'Green',
                'border' => '#49ab85',
                'background' => '#207856',
                'text' => '#00ac69',
            ],
            [
                'name' => 'Teal',
                'border' => '#4da18f',
                'background' => '#126e5b',
                'text' => '#00ba94',
            ],
            [
                'name' => 'cyan',
                'border' => '#3db7ba',
                'background' => '#097275',
                'text' => '#00cfd5',
            ],
            [
                'name' => 'Blue',
                'border' => '#3768b0',
                'background' => '#083475',
                'text' => '#0061f2',
            ],
            [
                'name' => 'Indigo',
                'border' => '#5f32a6',
                'background' => '#2d066b',
                'text' => '#5800e8',
            ],
            [
                'name' => 'Purple',
                'border' => '#8c53bd',
                'background' => '#411369',
                'text' => '#6900c7',
            ],
            [
                'name' => 'Pink',
                'border' => '#b84472',
                'background' => '#80113d',
                'text' => '#e30059',
            ],
        ];

        foreach($colors as $attributes){
            $color = new Color($attributes);
            $color->save();
        }
    }

}
