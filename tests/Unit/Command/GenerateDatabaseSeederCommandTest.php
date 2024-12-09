<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\GenerateDatabaseSeederCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateDatabaseSeederCommandTest extends TestCase
{
    private $commandTester;

    protected function setUp(): void
    {
        $application = new Application;
        $application->add(new GenerateDatabaseSeederCommand);
        $command = $application->find('database');
        $this->commandTester = new CommandTester($command);
    }

    public function test_execute(): void
    {
        $this->commandTester->execute([]);

        $this->assertStringContainsString('generate-database-seeder command executed successfully.', trim($this->commandTester->getDisplay()));
    }
}
