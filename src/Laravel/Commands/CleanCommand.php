<?php

namespace Cable8mm\Xeed\Laravel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanCommand extends Command
{
    public const TABLE_NAME = 'xeeds';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:clean {--question}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean generated files, seeders, models, factories and migration files.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->choice(
            'Please select directory for you to want to clean.',
            ['seeder', 'model', 'factory', 'migration', 'all', 'exit'],
            'exit'
        );

        $paths = match ($name) {
            'seeder' => [database_path('seeders')],
            'model' => [app_path('Models')],
            'factory' => [database_path('factories')],
            'migration' => [database_path('migrations')],
            'all' => [
                database_path('seeders'),
                app_path('Models'),
                database_path('factories'),
                database_path('migrations'),
            ],
            default => null,
        };

        $this->info('You have just selected: '.$name);

        if ($paths === null) {
            return Command::SUCCESS;
        }

        foreach ($paths as $path) {
            array_map(function ($location) {
                File::delete($location);

                $this->info($location.' was deleted.');
            }, array_filter((array) glob($path.DIRECTORY_SEPARATOR.'*.php')));
        }

        return Command::SUCCESS;
    }
}
