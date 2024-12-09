<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\GenerateModelsCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateModelsCommandTest extends TestCase
{
    private $commandTester;

    protected function setUp(): void
    {
        $application = new Application;
        $application->add(new GenerateModelsCommand);
        $command = $application->find('models');
        $this->commandTester = new CommandTester($command);
    }

    public function test_execute(): void
    {
        $this->commandTester->execute([]);

        $this->assertStringContainsString('generate-models command executed successfully.', trim($this->commandTester->getDisplay()));
    }

    public function test_execute_with_a_table(): void
    {
        $this->commandTester->execute([
            '--force' => true,
        ], [
            '--table' => 'xeeds',
        ]);

        $this->assertStringContainsString('generate-models command executed successfully.', trim($this->commandTester->getDisplay()));
    }
}
