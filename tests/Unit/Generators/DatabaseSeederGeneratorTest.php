<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Generators\DatabaseSeederGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class DatabaseSeederGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        DatabaseSeederGenerator::make(
            [
                new Table('one_samples'),
                new Table('two_samples'),
            ],
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'DatabaseSeeder.php');
    }

    public function test_it_can_generate_database_seeder_file(): void
    {
        $this->assertFileExists(__DIR__.'/../../../'.Path::testgen().DIRECTORY_SEPARATOR.'DatabaseSeeder.php');
    }
}
