<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Generators\FactoryGenerator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate factories.
 *
 * Run `bin/console generate-factories` or `bin/console factories`
 */
#[AsCommand(
    name: 'generate-factories',
    description: 'Generate factories. run `bin/console generate-factories` or `bin/console factories`',
    hidden: false,
    aliases: ['factories']
)]
class GenerateFactoriesCommand extends Command
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
            FactoryGenerator::make($table)->run();
        }

        return Command::SUCCESS;
    }
}
