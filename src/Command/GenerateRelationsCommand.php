<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Generators\RelationGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Xeed;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate relations.
 *
 * Run `bin/console generate-relations` or `bin/console relations`
 */
#[AsCommand(
    name: 'generate-relations',
    description: 'Generate relations. run `bin/console generate-relations` or `bin/console relations`',
    hidden: false,
    aliases: ['relations', 'relation']
)]
class GenerateRelationsCommand extends Command
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
                'models',
                'm',
                InputOption::VALUE_OPTIONAL,
                'Run xseed:models before?',
                false
            )->addOption(
                'force',
                'f',
                InputOption::VALUE_OPTIONAL,
                'Are files forcibly deleted even if they exist?',
                false
            );
    }

    /**
     * Run the console command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $force = $input->getOption('force') ?? true;

        $models = $input->getOption('models') ?? true;

        $tables = Xeed::getInstance()->attach()->getTables();

        foreach ($tables as $table)
        {
            try
            {
                if ($models)
                {
                    ModelGenerator::make($table)->run($force);
                    $output->writeln('<info>' . Path::model() . DIRECTORY_SEPARATOR . $table->model() . '.php have been generated.' . '</info>');
                }
                RelationGenerator::make($table)->run($force);

                $output->writeln('<info>Relations of ' . $table->model() . ' have been generated.</info>');
            }
            catch (\RuntimeException $e)
            {
                $output->writeln('<error>Error creating relations of ' . $table->model() . '.<error>');
            }
        }

        $output->writeln('<info>generate-relations</info> command executed successfully.');

        return Command::SUCCESS;
    }
}
