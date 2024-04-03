<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\Generators\FakerSeederGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Xeed;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate seeders.
 *
 * Run `bin/console generate-seeders` or `bin/console seeders`
 */
#[AsCommand(
    name: 'generate-faker-seeders',
    description: 'Generate faker seeders. run `bin/console generate-faker-seeders` or `bin/console fakers`',
    hidden: false,
    aliases: ['faker-seeders', 'fakers', 'faker']
)]
class GenerateFakerSeedersCommand extends Command
{
    /**
     * Configure the command.
     */
    protected function configure(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
        $dotenv->safeLoad();

        $this
            ->addOption(
                'force',
                'f',
                InputOption::VALUE_OPTIONAL,
                'Are files forcibly deleted even if they exist?',
                false
            )->addOption(
                'table',
                't',
                InputOption::VALUE_OPTIONAL,
                'Are you generating the specific table with the faker seed?',
                null
            );
    }

    /**
     * Run the console command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $force = $input->getOption('force') ?? true;

        $table = $input->getOption('table');

        $tables = is_null($table)
            ? Xeed::getInstance()->attach()->getTables()
            : Xeed::getInstance()->attach($table)->getTables();

        foreach ($tables as $table) {
            try {
                FakerSeederGenerator::make($table)->run(force: $force);

                $output->writeln('<info>'.Path::seeder().DIRECTORY_SEPARATOR.$table->seeder().'.php have been generated.'.'</info>');
            } catch (\RuntimeException $e) {
                $output->writeln('<error>'.Path::seeder().DIRECTORY_SEPARATOR.$table->seeder().'.php file already exists.'.'</error>');
            }
        }

        $output->writeln('<info>generate-faker-seeders</info> command executed successfully.');

        return Command::SUCCESS;
    }
}
