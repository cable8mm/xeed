<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\SeederGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class SeederGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'SampleSeeder.php');

        SeederGenerator::make(
            new Table('samples', [
                Column::make('id', 'bigint'),
            ]),
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'SampleSeeder.php');
    }

    public function test_it_generates_seeder_file(): void
    {
        $this->assertFileExists(Path::testgen().DIRECTORY_SEPARATOR.'SampleSeeder.php');
    }

    public function test_it_uses_default_model_namespace(): void
    {
        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.'SampleSeeder.php');

        $this->assertStringContainsString('\\App\\Models\\Sample::factory()->count(10)->create();', $file);
    }

    public function test_it_can_use_custom_model_namespace(): void
    {
        $filename = Path::testgen().DIRECTORY_SEPARATOR.'SampleSeeder.php';

        SeederGenerator::make(
            new Table('samples', [
                Column::make('id', 'bigint'),
            ]),
            namespace: 'App\\Domain\\Models',
            destination: Path::testgen()
        )->run(true);

        $file = File::system()->read($filename);

        $this->assertStringContainsString('App\\Domain\\Models\\Sample::factory()->count(10)->create();', $file);
    }
}
