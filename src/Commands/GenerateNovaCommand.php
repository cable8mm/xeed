<?php

namespace Cable8mm\Xeed\Commands;

use Cable8mm\Xeed\Generators\NovaResourceGenerator;
use Cable8mm\Xeed\Xeed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateNovaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:nova
                            {table? : Are you generating the specific table with the Nova resource?}
                            {--f|force : Are files forcibly deleted even if they exist?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Nova resource from your own database tables';

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
                NovaResourceGenerator::make(
                    $table,
                    destination: app_path('Nova')
                )->run(force: $force);

                $this->info(app_path('Nova').DIRECTORY_SEPARATOR.$table->nova().'.php has been generated.');
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }

        return Command::SUCCESS;
    }
}
