<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\MigrationGenerator;
use Cable8mm\Xeed\Mergers\MergerContainer;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class MigrationGeneratorTest extends TestCase
{
    public Table $table;

    protected function setUp(): void
    {
        $this->table = new Table('samples', [
            Column::make('id', 'bigint'),
            Column::make('name', 'varchar'),
        ]);

        MigrationGenerator::make(
            $this->table,
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->deleteDictionary(Path::testgen(), 'php');
    }

    public function test_it_can_generate_migration_file(): void
    {
        $this->assertFileExists(Path::testgen().DIRECTORY_SEPARATOR.$this->table->migration());
    }

    public function test_it_can_apply_mergers(): void
    {
        $table = new Table('morph_samples', [
            Column::make('id', 'bigint'),
            Column::make('morphs_type', 'varchar', bracket: '255'),
            Column::make('morphs_id', 'bigint', unsigned: true),
        ]);

        MigrationGenerator::make(
            $table,
            destination: Path::testgen()
        )->merging(MergerContainer::getEngines())->run(true);

        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.$table->migration());

        $this->assertStringContainsString('$table->nullableMorphs(\'morphs\');', $file);
        $this->assertStringNotContainsString('$table->string(\'morphs_type\', 255)->nullable();', $file);
        $this->assertStringNotContainsString('$table->foreignId(\'morphs_id\')->nullable();', $file);
    }
}
