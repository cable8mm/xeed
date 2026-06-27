<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\DatabaseSeederGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class DatabaseSeederGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        DatabaseSeederGenerator::make(
            [
                new Table('one_samples', [
                    Column::make('id', 'bigint'),
                ]),
                new Table('two_samples', [
                    Column::make('id', 'bigint'),
                ]),
            ],
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'DatabaseSeeder.php');
    }

    public function test_it_generates_database_seeder_file(): void
    {
        $this->assertFileExists(Path::testgen().DIRECTORY_SEPARATOR.'DatabaseSeeder.php');
    }

    public function test_it_respects_force_when_overwriting_existing_files(): void
    {
        $filename = Path::testgen().DIRECTORY_SEPARATOR.'DatabaseSeeder.php';

        $file = File::system();
        $file->write($filename, 'original', true);

        $this->expectException(RuntimeException::class);

        DatabaseSeederGenerator::make(
            [
                new Table('one_samples', [
                    Column::make('id', 'bigint'),
                ]),
                new Table('two_samples', [
                    Column::make('id', 'bigint'),
                ]),
            ],
            destination: Path::testgen()
        )->run();
    }

    public function test_it_can_force_overwrite_existing_files(): void
    {
        $filename = Path::testgen().DIRECTORY_SEPARATOR.'DatabaseSeeder.php';

        $file = File::system();
        $file->write($filename, 'original', true);

        DatabaseSeederGenerator::make(
            [
                new Table('one_samples', [
                    Column::make('id', 'bigint'),
                ]),
                new Table('two_samples', [
                    Column::make('id', 'bigint'),
                ]),
            ],
            destination: Path::testgen()
        )->run(true);

        $this->assertStringNotContainsString('original', $file->read($filename));
        $this->assertStringContainsString('OneSampleSeeder::class', $file->read($filename));
        $this->assertStringContainsString('TwoSampleSeeder::class', $file->read($filename));
    }
}
