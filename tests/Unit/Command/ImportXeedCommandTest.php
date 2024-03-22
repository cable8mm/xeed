<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\ImportXeedCommand;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ImportXeedCommandTest extends TestCase
{
    public $commandTester;

    public string $table = '';

    protected function setUp(): void
    {
        $this->table = (Xeed::getInstance()->driver === 'pgsql' ? 'public.' : '').ImportXeedCommand::TABLE_NAME;
    }

    public function test_execute(): void
    {
        $application = new Application();
        $application->add(new ImportXeedCommand());
        $command = $application->find('import-xeed');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'argument' => 'import',
            '-f',
        ]);

        $this->assertStringContainsString('command executed successfully', $commandTester->getDisplay());
    }

    public function test_execute_drop(): void
    {
        $application = new Application();
        $application->add(new ImportXeedCommand());
        $command = $application->find('import-xeed');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'argument' => 'drop',
        ]);

        $this->assertStringContainsString('command executed successfully', $commandTester->getDisplay());
    }

    public function test_execute_refresh(): void
    {
        $application = new Application();
        $application->add(new ImportXeedCommand());
        $command = $application->find('import-xeed');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'argument' => 'refresh',
            '-f',
        ]);

        $this->assertStringContainsString('command executed successfully', $commandTester->getDisplay());
    }
}
