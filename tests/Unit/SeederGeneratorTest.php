<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Generators\SeederGenerator;
use PHPUnit\Framework\TestCase;

final class SeederGeneratorTest extends TestCase
{
    public function test_it_can_can_generate_seeder(): void
    {
        $seederGenerator = SeederGenerator::make(
            'Sample',
            namespace: '\App\Models'
        );

        $seederGenerator->run();

        $outputPath = __DIR__.'/../../dist/SampleSeeder.php';

        $this->assertFileExists($outputPath);
    }
}
