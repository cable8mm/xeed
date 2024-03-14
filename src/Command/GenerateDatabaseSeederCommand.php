<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Generators\DatabaseSeederGenerator;
use Cable8mm\Xeed\Support\Inflector;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'generate-database-seeder',
    description: 'Generate seeders. run `bin/console generate-database-seeder`',
    hidden: false,
    aliases: ['database']
)]
class GenerateDatabaseSeederCommand extends Command
{
    protected function configure()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
        $dotenv->safeLoad();
    }

    /**
     * Generate models.
     *
     * Run `bin/console generate-seeders` or `bin/console seeders`
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tables = DB::getInstance()->attach()->getTables();

        $classes = [];

        foreach ($tables as $table) {
            $classes[] = Inflector::classify($table->name);
        }

        DatabaseSeederGenerator::make($classes)->run();

        return Command::SUCCESS;
    }
}
