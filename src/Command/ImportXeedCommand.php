<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Support\Path;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Import xeed table.
 *
 * Run `bin/console import-xeed` or `bin/console xeed`
 */
#[AsCommand(
    name: 'import-xeed',
    description: 'Import xeed sql for testing. run `bin/console import-xeed`',
    hidden: false,
    aliases: ['xeed']
)]
class ImportXeedCommand extends Command
{
    /**
     * Configure the command.
     */
    protected function configure(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
        $dotenv->safeLoad();

        $this
            ->addArgument('drop', InputArgument::OPTIONAL, 'Drop xeeds table?');
    }

    /**
     * Run the console command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $drop = $input->getArgument('drop');

        $db = DB::getInstance();

        if ($drop) {
            $db->prepare('DROP TABLE xeeds')->execute();
        } else {
            $sql = file_get_contents(Path::resourceTest().'xeeds.'.$db->driver.'.sql');

            $db->exec($sql);
        }

        return Command::SUCCESS;
    }
}
