<?php

namespace Database\Seeders\Deploy;

use App\Models\Bot\ScamCategory;
use App\Models\Bot\ScamStatus as ScamStatusEntity;
use Illuminate\Database\Seeder;

class ScamStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scamStatuses = [
            [
                'name' => 'New',
                'color_id' => '1',
            ],
            [
                'name' => 'Need to write post',
                'color_id' => '2',
            ],
            [
                'name' => 'Posted',
                'color_id' => '4',
            ],
            [
                'name' => 'Declined',
                'color_id' => '3',
            ],
        ];

        foreach($scamStatuses as $attributes){
            $scamStatus = new ScamStatusEntity($attributes);
            $scamStatus->save();
        }

        $scamCategories = [
            [
                'name' => 'Rug',
                'color_id' => '3',
            ],
            [
                'name' => 'Drain',
                'color_id' => '3',
            ],
            [
                'name' => 'Exploit',
                'color_id' => '2',
            ],
            [
                'name' => 'Other',
                'color_id' => '1',
            ],
        ];

        foreach($scamCategories as $attributes){
            $scamCategory = new ScamCategory($attributes);
            $scamCategory->save();
        }
    }
}
