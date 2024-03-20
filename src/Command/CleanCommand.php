<?php

namespace Cable8mm\Xeed\Command;

use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToDeleteFile;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

/**
 * Clean generated files, seeders, models, factories and migration files.
 *
 * run `bin/console clean`
 */
#[AsCommand(
    name: 'clean',
    description: 'Clean generated files, seeders, models, factories and migration files. run `bin/console clean`',
    hidden: false
)]
class CleanCommand extends Command
{
    /**
     * Run the console command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $question = new ChoiceQuestion(
            'Please select directory for you to want to clean.',
            ['seeder', 'model', 'factory', 'migration', 'all', 'exit'],
            'exit'
        );

        $question->setErrorMessage('Type %s is invalid.');

        /** @disregard P1013 */
        $thing = $helper->ask($input, $output, $question);

        $output->writeln('You have just selected: '.$thing);

        $paths = match ($thing) {
            'seeder' => [Path::seeder()],
            'model' => [Path::model()],
            'factory' => [Path::factory()],
            'migration' => [Path::migration()],
            'all' => [
                Path::seeder(),
                Path::model(),
                Path::factory(),
                Path::migration(),
            ],
            default => null,
        };

        if ($paths === null) {
            $output->writeln('See you later!');

            return Command::SUCCESS;
        }

        foreach ($paths as $path) {
            try {
                array_map(function ($location) use ($output) {
                    File::system()->delete($location);

                    $output->writeln($location.' was deleted.');
                }, array_filter((array) glob($path.'*.php')));
            } catch (FilesystemException|UnableToDeleteFile $exception) {
                $output->writeln($exception->getMessage());
            }
        }

        return Command::SUCCESS;
    }
}
