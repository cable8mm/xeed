<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Generators\SeederGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class SeederGeneratorTest extends TestCase
{
    public function test_it_can_can_generate_seeder(): void
    {
        SeederGenerator::make(new Table('samples'))->run();

        $outputPath = Path::seeder().'SampleSeeder.php';

        $this->assertFileExists($outputPath);
    }
}
