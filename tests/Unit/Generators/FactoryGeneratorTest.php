<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\FactoryGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class FactoryGeneratorTest extends TestCase
{
    public Table $table;

    protected function setUp(): void
    {
        $this->table = new Table('samples', [
            Column::make('id', 'bigint'),
            Column::make('name', 'varchar'),
        ]);

        FactoryGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'SampleFactory.php');
    }

    public function test_it_generates_factory_file(): void
    {
        $this->assertFileExists(Path::testgen().DIRECTORY_SEPARATOR.'SampleFactory.php');
    }

    public function test_it_respects_force_when_overwriting_existing_files(): void
    {
        $filename = Path::testgen().DIRECTORY_SEPARATOR.'SampleFactory.php';

        $file = File::system();
        $file->write($filename, 'original', true);

        $this->expectException(RuntimeException::class);

        FactoryGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run();
    }

    public function test_it_can_force_overwrite_existing_files(): void
    {
        $filename = Path::testgen().DIRECTORY_SEPARATOR.'SampleFactory.php';

        $file = File::system();
        $file->write($filename, 'original', true);

        FactoryGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run(true);

        $this->assertStringNotContainsString('original', $file->read($filename));
    }
}
