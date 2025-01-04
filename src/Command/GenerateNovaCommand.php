<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\Generators\NovaResourceGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Xeed;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate Nova fields.
 *
 * Run `bin/console generate-nova-fields` or `bin/console nova-fields`
 */
#[AsCommand(
    name: 'generate-nova-fields',
    description: 'Generate Nova fields. run `bin/console generate-nova-fields` or `bin/console nova-fields`',
    hidden: false,
    aliases: ['nova-fields', 'novas']
)]
class GenerateNovaCommand extends Command
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
                'Are you generating the specific table with the nova field?',
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

        $tables = array_filter($tables, function ($table) {
            return ! in_array($table, Xeed::LARAVEL_DEFAULT_TABLES);
        });

        foreach ($tables as $table) {
            try {
                NovaResourceGenerator::make($table)->run(force: $force);

                $output->writeln('<info>'.Path::nova().DIRECTORY_SEPARATOR.$table->nova().'.php have been generated.'.'</info>');
            } catch (\RuntimeException $e) {
                $output->writeln('<error> => '.$e->getMessage().'</error>');
            }
        }

        $output->writeln('<info>generate-nova-fields</info> command executed successfully.');

        return Command::SUCCESS;
    }
}
