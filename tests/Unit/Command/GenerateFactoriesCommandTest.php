<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\GenerateFactoriesCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateFactoriesCommandTest extends TestCase
{
    private $commandTester;

    protected function setUp(): void
    {
        $application = new Application();
        $application->add(new GenerateFactoriesCommand());
        $command = $application->find('factories');
        $this->commandTester = new CommandTester($command);
    }

    public function test_execute(): void
    {
        $this->commandTester->execute([]);

        $this->assertStringContainsString('generate-factories command executed successfully.', trim($this->commandTester->getDisplay()));
    }

    public function test_execute_specific_table(): void
    {
        $this->commandTester->execute([
            '--table' => 'xeeds',
            '--force' => true,
        ]);

        $this->assertStringContainsString('generate-factories command executed successfully.', trim($this->commandTester->getDisplay()));
    }
}
