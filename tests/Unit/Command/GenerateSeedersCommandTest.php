<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\GenerateSeedersCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateSeedersCommandTest extends TestCase
{
    private $commandTester;

    protected function setUp(): void
    {
        $application = new Application;
        $application->add(new GenerateSeedersCommand);
        $command = $application->find('seeders');
        $this->commandTester = new CommandTester($command);
    }

    public function test_execute(): void
    {
        $this->commandTester->execute([
            '--force' => true,
        ]);

        $this->assertStringContainsString('generate-seeders command executed successfully.', trim($this->commandTester->getDisplay()));
    }

    public function test_execute_with_a_table(): void
    {
        $this->commandTester->execute([
            '--force' => true,
        ], [
            '--table' => 'xeeds',
        ]);

        $this->assertStringContainsString('generate-seeders command executed successfully.', trim($this->commandTester->getDisplay()));
    }
}
