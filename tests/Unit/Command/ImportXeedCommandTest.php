<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\ImportXeedCommand;
use Cable8mm\Xeed\Xeed;
use PDOException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ImportXeedCommandTest extends TestCase
{
    private $commandTester;

    protected function setUp(): void
    {
        $application = new Application();
        $application->add(new ImportXeedCommand());
        $command = $application->find('import-xeed');
        $this->commandTester = new CommandTester($command);
    }

    public function test_execute(): void
    {
        $this->commandTester->execute([
            'argument' => 'import',
            '-f',
        ]);

        try {
            Xeed::getInstance()->query('SELECT 1 FROM '.ImportXeedCommand::TABLE_NAME);

            $this->assertTrue(true);
        } catch (PDOException $e) {
            $this->assertTrue(false);
        }

        $this->commandTester->execute([
            'argument' => 'drop',
        ]);

        try {
            Xeed::getInstance()->query('SELECT 1 FROM '.ImportXeedCommand::TABLE_NAME);

            $this->assertTrue(false);
        } catch (PDOException $e) {
            $this->assertTrue(true);
        }

        $this->commandTester->execute([
            'argument' => 'refresh',
            '-f',
        ]);

        try {
            Xeed::getInstance()->query('SELECT 1 FROM '.ImportXeedCommand::TABLE_NAME);

            $this->assertTrue(true);
        } catch (PDOException $e) {
            $this->assertTrue(false);
        }
    }
}
