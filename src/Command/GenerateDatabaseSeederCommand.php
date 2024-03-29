<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\Generators\DatabaseSeederGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Xeed;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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

        try {
            DatabaseSeederGenerator::make($tables)->run(force: $force);

            $output->writeln('<info>'.Path::seeder().DIRECTORY_SEPARATOR.'DatabaseSeeder.php seeder have been generated.'.'</info>');
        } catch (\RuntimeException $e) {
            $output->writeln('<error>'.Path::seeder().DIRECTORY_SEPARATOR.'DatabaseSeeder.php seeder file already exists.'.'</error>');
        }

        $output->writeln('<info>generate-database-seeder</info> command executed successfully.');

        return Command::SUCCESS;
    }
}
