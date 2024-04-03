<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\FakerSeederGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class FakerSeederGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        FakerSeederGenerator::make(
            new Table('samples', [
                Column::make('id', 'bigint'),
            ]),
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        // File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'SampleSeeder.php');
    }

    public function test_it_can_can_generate_seeder_file(): void
    {
        $this->assertFileExists(Path::testgen().DIRECTORY_SEPARATOR.'SampleSeeder.php');
    }
}
