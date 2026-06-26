<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\ForeignKey;
use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Generators\RelationGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class RelationGeneratorTest extends TestCase
{
    public Table $table;

    public Table $related;

    protected function setUp(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Related.php');

        $this->table = new Table('samples', [
            Column::make('id', 'bigInteger', autoIncrement: true, primaryKey: true),
            Column::make('related_id', 'bigInteger'),
            Column::make('created_at', 'timestamp'),
            Column::make('updated_at', 'timestamp'),
        ], [
            ForeignKey::make('samples_related_fk', 'Sample', 'related_id', 'Related', 'id'),
        ]);

        $this->related = new Table('related', [
            Column::make('id', 'bigInteger', autoIncrement: true, primaryKey: true),
            Column::make('created_at', 'timestamp'),
            Column::make('updated_at', 'timestamp'),
        ]);

        ModelGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run(true);

        ModelGenerator::make(
            $this->related,
            destination: Path::testgen()
        )->run(true);

        RelationGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run(true);

        RelationGenerator::make(
            $this->related,
            destination: Path::testgen()
        )->run(true);
    }

    protected function tearDown(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Related.php');
        File::system()->deleteDictionary(Path::testgen(), 'php');
    }

    public function test_it_can_generate_relations(): void
    {
        $this->assertFileEquals(
            Path::testExpected().DIRECTORY_SEPARATOR.'Sample.sample',
            Path::testgen().DIRECTORY_SEPARATOR.'Sample.php'
        );
        $this->assertFileEquals(
            Path::testExpected().DIRECTORY_SEPARATOR.'Related.sample',
            Path::testgen().DIRECTORY_SEPARATOR.'Related.php'
        );
    }

    public function test_it_can_force_overwrite_related_model_files(): void
    {
        $filename = Path::testgen().DIRECTORY_SEPARATOR.'Sample.php';

        $file = File::system();
        $original = $file->read(Path::testExpected().DIRECTORY_SEPARATOR.'Sample.sample');
        $file->write($filename, str_replace('public function related()', 'original public function related()', $original), true);

        RelationGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run(true);

        $file = $file->read($filename);

        $this->assertStringContainsString('belongsTo(Related::class, \'related_id\')', $file);
    }
}
