<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Xeed;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate models.
 *
 * Run `bin/console generate-models` or `bin/console models`
 */
#[AsCommand(
    name: 'generate-models',
    description: 'Generate models. run `bin/console generate-models` or `bin/console models`',
    hidden: false,
    aliases: ['models', 'model']
)]
class GenerateModelsCommand extends Command
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
                'Are you generating the specific table with the model?',
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
                ModelGenerator::make($table)->run(force: $force);

                $output->writeln('<info>'.Path::model().DIRECTORY_SEPARATOR.$table->model().'.php have been generated.'.'</info>');
            } catch (\RuntimeException $e) {
                $output->writeln('<error>'.Path::model().DIRECTORY_SEPARATOR.$table->model().'.php file already exists.'.'</error>');
            }
        }

        $output->writeln('<info>generate-models</info> command executed successfully.');

        return Command::SUCCESS;
    }
}
