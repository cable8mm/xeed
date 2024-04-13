<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\GenerateRelationsCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateRelationsCommandTest extends TestCase
{
    private $commandTester;

    protected function setUp(): void
    {
        $application = new Application();
        $application->add(new GenerateRelationsCommand());
        $command = $application->find('relations');
        $this->commandTester = new CommandTester($command);
    }

    public function test_execute(): void
    {
        $this->commandTester->execute([]);

        $this->assertStringContainsString('generate-relations command executed successfully.', trim($this->commandTester->getDisplay()));
    }

    public function test_execute_with_a_table(): void
    {
        $this->commandTester->execute([
            '--models' => true,
        ], [
            '--force' => true,
        ]);

        $this->assertStringContainsString('generate-relations command executed successfully.', trim($this->commandTester->getDisplay()));
    }
}
