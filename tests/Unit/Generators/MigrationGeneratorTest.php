<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\MigrationGenerator;
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
        $this->assertFileExists(__DIR__.'/../../../'.Path::testgen().$this->table->migration());
    }
}
