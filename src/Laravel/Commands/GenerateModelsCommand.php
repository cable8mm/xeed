<?php

namespace Cable8mm\Xeed\Laravel\Commands;

use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Xeed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateModelsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:models {force=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate models from your own database tables';

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
                ModelGenerator::make(
                    $table,
                    destination: app_path('Models')
                )->run(force: $force);

                $this->info(app_path('Models').DIRECTORY_SEPARATOR.$table->model().'.php has been generated.');
            } catch (\Exception $e) {
                $this->error(app_path('Models').DIRECTORY_SEPARATOR.$table->model().'.php file already exists.');
            }
        }

        return Command::SUCCESS;
    }
}
