<?php

namespace Cable8mm\Xeed\Laravel\Commands;

use Cable8mm\Xeed\Generators\FakerSeederGenerator;
use Cable8mm\Xeed\Xeed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateFakerSeedersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:faker-seeders
                            {--f|force : Are files forcibly deleted even if they exist?}
                            {--t|table= : Are you generating the specific table with the faker seeder?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate faker seeders from your own database tables';

    protected function configure()
    {
        $this->setAliases([
            'xeed:fakers',
            'xeed:faker',
        ]);

        parent::configure();
    }

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
                FakerSeederGenerator::make(
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
