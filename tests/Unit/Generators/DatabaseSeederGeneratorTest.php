<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Generators\DatabaseSeederGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class DatabaseSeederGeneratorTest extends TestCase
{
    public function test_it_can_generate_database_seeder(): void
    {
        DatabaseSeederGenerator::make([
            new Table('one_samples'),
            new Table('two_samples'),
        ])->run();

        $outputPath = Path::seeder().'DatabaseSeeder.php';

        $this->assertFileExists($outputPath);
    }
}
