<?php

namespace Cable8mm\Xeed\Laravel\Commands;

use Cable8mm\Xeed\Generators\FactoryGenerator;
use Cable8mm\Xeed\Xeed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateFactoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:factories
                            {force=false : Are files forcibly deleted even if they exist?}
                            {--t|table= : Are you generating the specific table with the factory?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate factories from your own database tables';

    /**
     * Execute the console command.
     */
    public function handle(Xeed $xeed)
    {
        $force = $this->argument('force');

        $table = $this->option('table');

        $tables = is_null($table)
            ? $xeed->addPdo(DB::connection()->getPDO())->attach()->getTables()
            : $xeed->addPdo(DB::connection()->getPDO())->attach($table)->getTables();

        foreach ($tables as $table) {
            try {
                FactoryGenerator::make(
                    $table,
                    destination: database_path('factories')
                )->run(force: $force);

                $this->info(database_path('factories').DIRECTORY_SEPARATOR.$table->factory().'.php seeder have been generated.');
            } catch (\Exception $e) {
                $this->error(database_path('factories').DIRECTORY_SEPARATOR.$table->factory().'.php seeder file already exists.');
            }
        }
    }
}
