<?php

namespace Cable8mm\Xeed\Tests\Unit\Command;

use Cable8mm\Xeed\Command\GenerateSeedersCommand;
use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Support\Path;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateSeedersCommandTest extends TestCase
{
    private $commandTester;

    protected function setUp(): void
    {
        $application = new Application();
        $application->add(new GenerateSeedersCommand());
        $command = $application->find('seeders');
        $this->commandTester = new CommandTester($command);
    }

    public function test_execute(): void
    {
        $this->commandTester->execute([]);

        $this->assertEquals('Seeders have been generated.', trim($this->commandTester->getDisplay()));

        $tables = DB::getInstance()->attach()->getTables();

        foreach ($tables as $table) {
            $this->assertFileExists(Path::seeder().$table->model().'Seeder.php');
        }
    }
}
