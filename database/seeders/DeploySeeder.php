<?php

namespace Database\Seeders;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DeploySeeder extends Seeder
{

    /**
     * These seeders are run only once
     * @return void
     */
    public function run()
    {
        $this->checkTable();
        $executedSeeders = DB::table('seeds')->pluck('seed');

        if (is_dir(database_path('seeders/deploy'))) {
            $files = glob(database_path('seeders/deploy/*.php'));
            foreach ($files as $file) {
                $baseName = str_replace('.php', '', basename($file));
                if (!$executedSeeders->contains($baseName)) {
                    DB::transaction(function () use ($file, $baseName) {
                        // These seeders are called in a transaction
                        // So if it fails the "log" record wont be written
                        $this->call('Database\Seeders\Deploy\\' . ucfirst(Str::camel(substr($baseName, 17))));
                        DB::table('seeds')->insert(['seed' => $baseName]);
                    });
                }
            }
        }
    }

    private function checkTable()
    {
        if (!Schema::hasTable('seeds')) {
            Schema::create('seeds', function (Blueprint $table) {
                $table->id();
                $table->string('seed');
            });
        }
    }
}
