<?php

namespace Cable8mm\Xeed\Laravel\Commands;

use Cable8mm\Xeed\Generators\NovaResourceGenerator;
use Cable8mm\Xeed\Xeed;
use Illuminate\Console\Command;

class GenerateNovaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:nova
                            {--f|force : Are files forcibly deleted even if they exist?}
                            {--t|table= : Are you generating the specific table with the Nova resource?}';

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
        $force = $this->option('force') ?? false;

        $table = $this->option('table');

        $tables = is_null($table)
            ? Xeed::getInstance()->attach()->getTables()
            : Xeed::getInstance()->attach($table)->getTables();

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
