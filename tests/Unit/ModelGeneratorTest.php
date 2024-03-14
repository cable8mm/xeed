<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Generators\ModelGenerator;
use PHPUnit\Framework\TestCase;

final class ModelGeneratorTest extends TestCase
{
    public function test_it_can_generate_model(): void
    {
        $modelGenerator = ModelGenerator::make(
            'Sample',
            dist: __DIR__.'/../../dist/Models/'
        );

        $modelGenerator->run();

        $this->assertFileExists(__DIR__.'/../../dist/Models/Sample.php');
    }
}
