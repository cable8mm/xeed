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
        $this->commandTester->execute(['drop']);

        $this->assertEquals('Table was imported.', trim($this->commandTester->getDisplay()));
    }

    // public function test_drop_execute(): void
    // {
    //     $this->commandTester->execute(['drop' => 'drop']);

    //     $this->assertEquals('Table was dropped.', trim($this->commandTester->getDisplay()));
    // }
}
