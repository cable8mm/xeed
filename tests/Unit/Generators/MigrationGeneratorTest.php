<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\MigrationGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class MigrationGeneratorTest extends TestCase
{
    public function test_it_can_generate_migration_file(): void
    {
        $table = new Table('samples', [
            Column::make('id', 'bigint'),
            Column::make('name', 'varchar'),
        ]);

        MigrationGenerator::make($table)->run();

        $this->assertFileExists(Path::migration().$table->migration());
    }
}
