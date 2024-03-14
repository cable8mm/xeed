<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Support\Path;
use PHPUnit\Framework\TestCase;

final class ModelGeneratorTest extends TestCase
{
    public function test_it_can_generate_model(): void
    {
        $modelGenerator = ModelGenerator::make(
            'Sample'
        );

        $modelGenerator->run();

        $this->assertFileExists(Path::model().'Sample.php');
    }
}
