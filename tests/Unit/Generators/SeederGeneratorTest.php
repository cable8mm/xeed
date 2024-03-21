<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Generators\SeederGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class SeederGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        SeederGenerator::make(
            new Table('samples'),
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'SampleSeeder.php');
    }

    public function test_it_can_can_generate_seeder_file(): void
    {
        $this->assertFileExists(__DIR__.'/../../../'.Path::testgen().DIRECTORY_SEPARATOR.'SampleSeeder.php');
    }
}
