<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Generators\DatabaseSeederGenerator;
use Cable8mm\Xeed\Generators\SeederGenerator;
use Cable8mm\Xeed\Support\Path;
use PHPUnit\Framework\TestCase;

final class SeederGeneratorTest extends TestCase
{
    public function test_it_can_can_generate_seeder(): void
    {
        $seederGenerator = SeederGenerator::make('Sample');

        $seederGenerator->run();

        $outputPath = Path::seeder().'SampleSeeder.php';

        $this->assertFileExists($outputPath);
    }

    public function test_it_can_generate_database_seeder(): void
    {
        $generator = DatabaseSeederGenerator::make(['Sample1', 'Sample2']);

        $generator->run();

        $outputPath = Path::seeder().'DatabaseSeeder.php';

        $this->assertFileExists($outputPath);
    }
}
