<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Support\Path;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'import-xeed',
    description: 'Import xeed sql for testing. run `bin/console import-xeed`',
    hidden: false,
    aliases: ['xeed']
)]
class ImportXeedCommand extends Command
{
    protected function configure()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
        $dotenv->safeLoad();

        $this
            ->addArgument('drop', InputArgument::OPTIONAL, 'Drop xeeds table?');
    }

    /**
     * Generate models.
     *
     * Run `bin/console generate-seeders` or `bin/console seeders`
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $drop = $input->getArgument('drop');

        if ($drop) {
            DB::getInstance()->prepare('DROP TABLE xeeds')->execute();
        } else {
            $sql = file_get_contents(Path::resourceTest().'xeeds.sql');

            DB::getInstance()->exec($sql);
        }

        return Command::SUCCESS;
    }
}
