<?php

namespace Cable8mm\Xeed\Laravel\Commands;

use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Generators\RelationGenerator;
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
    protected $signature = 'xeed:relations
                            {--m|models : Run xseed:models before?}
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
        $models = $this->option('models') ?? false;
        $tables = $xeed->addPdo(DB::connection()->getPDO())->attach()->getTables();

        foreach ($tables as $table)
        {
            try
            {
                if ($models)
                {
                    ModelGenerator::make($table)->run($force);
                    $this->info(app_path('Models') . DIRECTORY_SEPARATOR . $table->model() . '.php has been generated.');
                }
                RelationGenerator::make($table)->run();

                $this->info('Relations of ' . $table->model() . ' have been generated.');
            }
            catch (\Exception $e)
            {
                $this->error('Error creating relations of ' . $table->model() . '.');
            }
        }

        return Command::SUCCESS;
    }
}
