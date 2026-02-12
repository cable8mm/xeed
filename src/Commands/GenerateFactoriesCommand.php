<?php

namespace Cable8mm\Xeed\Commands;

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
    protected $signature = 'xeed:factory
                            {table? : Are you generating the specific table with the factory?}
                            {--f|force : Are files forcibly deleted even if they exist?}';

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
        $table = $this->argument('table') ?? null;

        $force = $this->option('force') ?? false;

        $tables = is_null($table)
            ? $xeed->addPdo(DB::connection()->getPDO())->attach()->getTables()
            : $xeed->addPdo(DB::connection()->getPDO())->attach($table)->getTables();

        $tables = array_filter($tables, function ($table) {
            return ! in_array($table, Xeed::LARAVEL_DEFAULT_TABLES);
        });

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
