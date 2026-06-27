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
use RuntimeException;

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

    public function test_it_can_force_overwrite_related_model_files_for_both_models(): void
    {
        $sampleFilename = Path::testgen().DIRECTORY_SEPARATOR.'Sample.php';
        $relatedFilename = Path::testgen().DIRECTORY_SEPARATOR.'Related.php';

        $file = File::system();
        $originalSample = $file->read(Path::testExpected().DIRECTORY_SEPARATOR.'Sample.sample');
        $originalRelated = $file->read(Path::testExpected().DIRECTORY_SEPARATOR.'Related.sample');

        $file->write($sampleFilename, str_replace('public function related()', 'original public function related()', $originalSample), true);
        $file->write($relatedFilename, str_replace('public function samples()', 'original public function samples()', $originalRelated), true);

        RelationGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run(true);

        $this->assertStringContainsString('belongsTo(Related::class, \'related_id\')', $file->read($sampleFilename));
        $this->assertStringContainsString('hasMany(Sample::class, \'related_id\')', $file->read($relatedFilename));
    }

    public function test_it_respects_force_when_overwriting_existing_related_model_files(): void
    {
        $filename = Path::testgen().DIRECTORY_SEPARATOR.'Related.php';

        $file = File::system();
        $original = $file->read(Path::testExpected().DIRECTORY_SEPARATOR.'Related.sample');
        $file->write($filename, str_replace('public function samples()', 'original public function samples()', $original), true);

        $this->expectException(RuntimeException::class);

        RelationGenerator::make(
            $this->related,
            destination: Path::testgen()
        )->run();
    }
}
