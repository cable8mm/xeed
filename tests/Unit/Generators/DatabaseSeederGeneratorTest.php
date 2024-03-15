<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Generators\DatabaseSeederGenerator;
use Cable8mm\Xeed\Support\Path;
use PHPUnit\Framework\TestCase;

final class DatabaseSeederGeneratorTest extends TestCase
{
    public function test_it_can_generate_database_seeder(): void
    {
        DatabaseSeederGenerator::make(['Sample1', 'Sample2'])->run();

        $outputPath = Path::seeder().'DatabaseSeeder.php';

        $this->assertFileExists($outputPath);
    }
}
