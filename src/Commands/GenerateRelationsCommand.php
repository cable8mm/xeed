<?php

namespace Cable8mm\Xeed\Commands;

use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Xeed;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateRelationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:relation
                            {--f|force : Are files forcibly deleted even if they exist?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add relations to your models';

    /**
     * Execute the console command.
     */
    public function handle(Xeed $xeed)
    {
        $force = $this->option('force') ?? false;

        $tables = $xeed->addPdo(DB::connection()->getPDO())->attach()->getTables();

        $tables = array_filter($tables, function ($table) {
            return ! in_array($table, Xeed::LARAVEL_DEFAULT_TABLES);
        });

        foreach ($tables as $table) {
            try {
                ModelGenerator::make(
                    $table,
                    destination: app_path('Models')
                )->run($force);
                $this->info(app_path('Models').DIRECTORY_SEPARATOR.$table->model().'.php has been generated.');
            } catch (\Exception $e) {
                $this->error('<error>`'.$table->model().'` model doesn\'t exist. Initially, you create models using `php artisan xeed:models`.<error>');
            }
        }

        return Command::SUCCESS;
    }
}
