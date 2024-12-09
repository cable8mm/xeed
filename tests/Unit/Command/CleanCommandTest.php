<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\CleanCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CleanCommandTest extends TestCase
{
    private $commandTester;

    protected function setUp(): void
    {
        $application = new Application;
        $application->add(new CleanCommand);
        $command = $application->find('clean');
        $this->commandTester = new CommandTester($command);
    }

    public function test_execute(): void
    {
        $this->commandTester->execute([]);

        $this->assertEquals('Please select directory for you to want to clean.
  [0] seeder
  [1] model
  [2] factory
  [3] migration
  [4] all
  [5] exit
 > You have just selected: exit', trim($this->commandTester->getDisplay()));
    }
}
