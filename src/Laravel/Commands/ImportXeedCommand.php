<?php

namespace Cable8mm\Xeed\Laravel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use function Orchestra\Testbench\package_path;

class ImportXeedCommand extends Command
{
    public const TABLE_NAME = 'xeeds';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xeed:import {argument=import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import xeed sql for testing.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pdo = DB::connection()->getPDO();

        $argument = $this->argument('argument');

        if ($argument === 'import') {
            $driver = $pdo->getAttribute(\PDO::ATTR_DRIVER_NAME);

            $filename = package_path('database/'.self::TABLE_NAME.'.'.$driver.'.sql');

            $body = File::get($filename);

            if (DB::unprepared($body)) {
                $this->info($filename.' was imported.');

                return Command::SUCCESS;
            }

            $this->error($filename.' was not imported.');

            return Command::FAILURE;
        }

        if ($argument === 'drop') {
            $sql = 'DROP TABLE IF EXISTS '.self::TABLE_NAME;

            DB::unprepared($sql);
        }
    }
}
