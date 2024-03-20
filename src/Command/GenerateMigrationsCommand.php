<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Generators\MigrationGenerator;
use Cable8mm\Xeed\Mergers\MergerContainer;
use Cable8mm\Xeed\Support\Path;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate migrations.
 *
 * Run `bin/console generate-migrations` or `bin/console migrations`
 */
#[AsCommand(
    name: 'generate-migrations',
    description: 'Generate migrations. run `bin/console generate-migrations` or `bin/console migrations`',
    hidden: false,
    aliases: ['migrations']
)]
class GenerateMigrationsCommand extends Command
{
    /**
     * Configure the command.
     */
    protected function configure(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
        $dotenv->safeLoad();
    }

    /**
     * Run the console command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tables = DB::getInstance()->attach()->getTables();

        foreach ($tables as $table) {
            try {
                MigrationGenerator::make($table)->merging(
                    MergerContainer::getEngines()
                )->run();

                $output->writeln(Path::migration().$table->migration().' has been generated.');
            } catch (\Exception $e) {
                $output->writeln(Path::migration().$table->migration().'.php file already exists.');
            }
        }

        return Command::SUCCESS;
    }
}
