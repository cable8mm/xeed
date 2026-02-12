<?php

namespace Cable8mm\Xeed\Commands;

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
    protected $signature = 'xeed:seeder
                            {table? : Are you generating the specific table with the seeder?}
                            {--f|force : Are files forcibly deleted even if they exist?}';

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
                SeederGenerator::make(
                    $table,
                    destination: database_path('seeders')
                )->run(force: $force);

                $this->info(database_path('seeders').DIRECTORY_SEPARATOR.$table->seeder().'.php has been generated.');
            } catch (\Exception $e) {
                $this->error(database_path('seeders').DIRECTORY_SEPARATOR.$table->seeder().'.php file already exists.');
            }
        }

        return Command::SUCCESS;
    }
}
