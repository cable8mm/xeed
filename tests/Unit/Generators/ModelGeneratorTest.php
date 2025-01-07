<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class ModelGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        ModelGenerator::make(
            new Table('samples', [
                Column::make('id', 'bigint'),
                Column::make('timestamp', 'timestamp'),
                Column::make('created_at', 'timestamp'),
                Column::make('updated_at', 'timestamp'),
            ]),
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');
    }

    public function test_it_can_generate_model_file(): void
    {
        $this->assertFileExists(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');
    }

    public function test_it_can_generate_timestamps(): void
    {
        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        $this->assertStringNotContainsString('timestamps', $file);
    }

    public function test_it_can_generate_without_timestamps(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        ModelGenerator::make(
            new Table('samples', [
                Column::make('id', 'bigint'),
            ]),
            destination: Path::testgen()
        )->run();

        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        $this->assertStringContainsString('timestamps', $file);
    }

    public function test_it_is_needed_to_properties(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        ModelGenerator::make(
            new Table('samples', [
                Column::make('id', 'bigint'),
            ]),
            destination: Path::testgen()
        )->run();

        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        $this->assertStringContainsString('timestamps', $file);
    }

    public function test_primary_key_is_null(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        ModelGenerator::make(
            new Table('samples', [
                Column::make('bigint', 'bigint'),
            ]),
            destination: Path::testgen()
        )->run();

        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        $this->assertStringContainsString('primaryKey = null', $file);
    }

    public function test_primary_key_is_empty_when_field_name_is_id(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        ModelGenerator::make(
            new Table('samples', [
                Column::make('id', 'bigint', unsigned: true, autoIncrement: true, primaryKey: true),
            ]),
            destination: Path::testgen()
        )->run();

        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        $this->assertStringNotContainsString('primaryKey', $file);
    }

    public function test_primary_key_is_empty_when_field_name_is_not_id(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        ModelGenerator::make(
            new Table('samples', [
                Column::make('play_code', 'varchar', unsigned: false, autoIncrement: false, primaryKey: true),
            ]),
            destination: Path::testgen()
        )->run();

        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        $this->assertStringContainsString('protected $primaryKey = \'play_code\';', $file);
    }
}
