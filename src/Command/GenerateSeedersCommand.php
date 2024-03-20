<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Generators\SeederGenerator;
use Cable8mm\Xeed\Support\Path;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate seeders.
 *
 * Run `bin/console generate-seeders` or `bin/console seeders`
 */
#[AsCommand(
    name: 'generate-seeders',
    description: 'Generate seeders. run `bin/console generate-seeders` or `bin/console seeders`',
    hidden: false,
    aliases: ['seeders']
)]
class GenerateSeedersCommand extends Command
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
                SeederGenerator::make($table)->run();

                $output->writeln(Path::seeder().$table->seeder().'.php have been generated.');
            } catch (\Exception $e) {
                $output->writeln(Path::seeder().$table->seeder().'.php file already exists.');
            }
        }

        return Command::SUCCESS;
    }
}
