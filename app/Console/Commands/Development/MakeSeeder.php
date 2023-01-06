<?php

namespace App\Console\Commands\Development;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;

class MakeSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:seeder {ClassName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a deploy seeder (similar to a migration executed only once)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $className = ucfirst(Str::camel($this->argument('ClassName')));
        $seederFileName = Carbon::now()->format('Y_m_d_his_') . Str::snake($className) . '.php';

        if (!is_dir(database_path('seeders/deploy'))) {
            mkdir(database_path('seeders/deploy'));
        }

        file_put_contents(database_path('seeders/deploy/' . $seederFileName), str_replace('{SeederClassName}', $className, <<<EOS
<?php

namespace Database\Seeders\Deploy;

use Illuminate\Database\Seeder;

class {SeederClassName} extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    }

}
EOS));
        app(Composer::class)->dumpAutoloads();

        $this->line("<info>Created seeder:</info> {$seederFileName}");

        return 0;
    }
}
