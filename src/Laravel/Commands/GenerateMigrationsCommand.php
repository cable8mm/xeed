<?php

namespace Cable8mm\Xeed\Laravel\Commands;

use Cable8mm\Xeed\Generators\MigrationGenerator;
use Cable8mm\Xeed\Mergers\MergerContainer;
use Cable8mm\Xeed\Xeed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateMigrationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:migrations {force=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate migrations from your own database tables';

    /**
     * Execute the console command.
     */
    public function handle(Xeed $xeed)
    {
        $force = $this->argument('force');

        $tables = $xeed->addPdo(
            DB::connection()->getPDO()
        )->attach()->getTables();

        foreach ($tables as $table) {
            try {
                MigrationGenerator::make(
                    $table,
                    destination: database_path('migrations')
                )->merging(
                    MergerContainer::getEngines()
                )->run(force: $force);

                $this->info(database_path('migrations').DIRECTORY_SEPARATOR.$table->factory().'.php has been generated.');
            } catch (\Exception $e) {
                $this->error(database_path('migrations').DIRECTORY_SEPARATOR.$table->factory().'.php file already exists.');
            }
        }

        return Command::SUCCESS;
    }
}
