<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\FactoryGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

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

    public function test_it_can_generate_factory_file(): void
    {
        $this->assertFileExists(Path::testgen().DIRECTORY_SEPARATOR.'SampleFactory.php');
    }
}
