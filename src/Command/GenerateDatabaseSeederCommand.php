<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Generators\DatabaseSeederGenerator;
use Cable8mm\Xeed\Support\Path;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate database seeder.
 *
 * Run `bin/console generate-database-seeders` or `bin/console database`
 */
#[AsCommand(
    name: 'generate-database-seeder',
    description: 'Generate seeders. run `bin/console generate-database-seeder` or `bin/console database`',
    hidden: false,
    aliases: ['database']
)]
class GenerateDatabaseSeederCommand extends Command
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

        try {
            DatabaseSeederGenerator::make($tables)->run(force: false);

            $output->writeln(Path::seeder().'DatabaseSeeder.php seeder have been generated.');
        } catch (\Exception $e) {
            $output->writeln(Path::seeder().'DatabaseSeeder.php seeder file already exists.');
        }

        return Command::SUCCESS;
    }
}
