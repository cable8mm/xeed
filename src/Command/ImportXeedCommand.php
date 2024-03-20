<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use PDOException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Import xeed table.
 *
 * Run `bin/console import-xeed` or `bin/console xeed`
 */
#[AsCommand(
    name: 'import-xeed',
    description: 'Import xeed sql for testing. run `bin/console import-xeed` or `bin/console xeed`',
    hidden: false,
    aliases: ['xeed']
)]
class ImportXeedCommand extends Command
{
    public const TABLE_NAME = 'xeeds';

    /**
     * Configure the command.
     */
    protected function configure(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
        $dotenv->safeLoad();

        $this
            ->addArgument(
                'argument',
                InputArgument::OPTIONAL,
                'Drop xeeds table?',
                'import',
                ['import', 'drop', 'refresh']
            )
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

        $argument = $input->getArgument('argument');

        $db = DB::getInstance();

        if ($argument === 'drop' || $argument === 'refresh') {
            $sql = 'DROP TABLE IF EXISTS '.self::TABLE_NAME;

            $db->exec($sql);

            $output->writeln('`'.self::TABLE_NAME.'` table was dropped.');
        }

        if ($argument === 'import' || $argument === 'refresh') {
            if (! $force) {
                try {
                    $db->query('SELECT 1 FROM '.self::TABLE_NAME);
                } catch (PDOException $e) {
                    $filename = Path::database().self::TABLE_NAME.'.'.$db->driver.'.sql';

                    $sql = File::system()->read($filename);

                    $db->exec($sql);

                    $output->writeln($filename.' was imported.');

                    return Command::SUCCESS;
                }
            }

            $output->writeln('`'.self::TABLE_NAME.'` table already exists.');

            return Command::FAILURE;
        }

        throw new \RuntimeException('Something went wrong.');
    }
}
