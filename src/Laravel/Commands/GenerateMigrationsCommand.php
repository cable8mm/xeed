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
    protected $signature = 'xeed:migrations
                            {--f|force : Are files forcibly deleted even if they exist?}
                            {--t|table= : Are you generating the specific table with the migration?}';

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
        $force = $this->option('force') ?? false;

        $table = $this->option('table');

        $tables = is_null($table)
            ? $xeed->addPdo(DB::connection()->getPDO())->attach()->getTables()
            : $xeed->addPdo(DB::connection()->getPDO())->attach($table)->getTables();

        $tables = array_filter($tables, function ($table) {
            return ! in_array($table, Xeed::LARAVEL_DEFAULT_TABLES);
        });

        foreach ($tables as $table) {
            try {
                MigrationGenerator::make(
                    $table,
                    destination: database_path('migrations')
                )->merging(
                    MergerContainer::getEngines()
                )->run(force: $force);

                $this->info('A migration file for '.$table.' table has been generated.');
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }

        return Command::SUCCESS;
    }
}
