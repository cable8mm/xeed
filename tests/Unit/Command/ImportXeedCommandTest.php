<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\ImportXeedCommand;
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
        $this->commandTester->execute(['argument' => 'import']);

        $this->assertStringContainsString('was imported.', trim($this->commandTester->getDisplay()));
    }

    public function test_drop_execute(): void
    {
        $this->commandTester->execute(['argument' => 'drop']);

        $this->assertStringContainsString('was dropped.', trim($this->commandTester->getDisplay()));
    }

    public function test_refresh_execute(): void
    {
        $this->commandTester->execute(['argument' => 'refresh']);

        $this->assertStringContainsString('was dropped.', trim($this->commandTester->getDisplay()));
        $this->assertStringContainsString('was imported.', trim($this->commandTester->getDisplay()));
    }
}
