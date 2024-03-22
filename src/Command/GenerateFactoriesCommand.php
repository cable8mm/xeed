<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\Generators\FactoryGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Xeed;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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

        $this
            ->addOption(
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

        $tables = Xeed::getInstance()->attach()->getTables();

        foreach ($tables as $table) {
            try {
                FactoryGenerator::make($table)->run(force: $force);

                $output->writeln('<info>'.Path::factory().DIRECTORY_SEPARATOR.$table->factory().'.php have been generated.'.'</info>');
            } catch (\RuntimeException $e) {
                $output->writeln('<error>'.Path::factory().DIRECTORY_SEPARATOR.$table->factory().'.php file already exists.'.'<error>');
            }
        }

        $output->writeln('<info>generate-factories</info> command executed successfully.');

        return Command::SUCCESS;
    }
}
