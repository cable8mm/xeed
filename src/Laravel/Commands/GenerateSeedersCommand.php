<?php

namespace Cable8mm\Xeed\Laravel\Commands;

use Cable8mm\Xeed\Generators\SeederGenerator;
use Cable8mm\Xeed\Xeed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateSeedersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:seeders {force=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate seeders from your own database tables';

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
                SeederGenerator::make(
                    $table,
                    destination: database_path('seeders')
                )->run(force: $force);

                $this->info(database_path('seeders').DIRECTORY_SEPARATOR.$table->factory().'.php has been generated.');
            } catch (\Exception $e) {
                $this->error(database_path('seeders').DIRECTORY_SEPARATOR.$table->factory().'.php file already exists.');
            }
        }

        return Command::SUCCESS;
    }
}
