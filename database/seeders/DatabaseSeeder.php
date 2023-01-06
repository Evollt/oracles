<?php

use Illuminate\Database\Seeder;
use Database\Seeders\DeploySeeder;
use Database\Seeders\Models\RolesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);

        // This is a special seeder which runs seeds from
        // database/deeds/deploy in a "migration" fashion
        // these seeds will be executed only once per project
        // lifetime (similar to migrations).
        $this->call(DeploySeeder::class);
    }
}
