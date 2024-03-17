<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\FactoryGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class FactoryGeneratorTest extends TestCase
{
    public function test_it_can_generate_factory_file(): void
    {
        FactoryGenerator::make(new Table('samples', [
            Column::make('id', 'bigint'),
            Column::make('name', 'varchar'),
        ]))->run();

        $this->assertFileExists(Path::factory().'SampleFactory.php');
    }
}
