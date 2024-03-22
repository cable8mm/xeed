<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Xeed;
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

        $xeed = Xeed::getInstance();

        if ($argument === 'drop' || $argument === 'refresh') {
            $sql = 'DROP TABLE IF EXISTS '.self::TABLE_NAME;

            if ($xeed->pdo->exec($sql) !== false) {
                $output->writeln('`'.self::TABLE_NAME.'` table was successfully dropped.');
            } else {
                $output->writeln('`'.self::TABLE_NAME.'` table failed to drop.');
            }
        }

        if ($argument === 'import' || $argument === 'refresh') {
            $filename = Path::database().DIRECTORY_SEPARATOR.self::TABLE_NAME.'.'.$xeed->driver.'.sql';

            switch ($xeed->driver) {
                case 'pgsql':
                    $sql = File::system()->readSql($filename);
                    break;
                default:
                    $sql = File::system()->read($filename);
                    break;
            }

            if ($xeed->pdo->exec($sql) !== false) {
                $output->writeln($filename.' was imported.');
            } else {
                $output->writeln($filename.' wasn\'t imported.');
            }
        }

        $output->writeln('<info>import-xeed</info> command executed successfully.');

        return Command::SUCCESS;
    }
}
