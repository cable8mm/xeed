<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class ModelGeneratorTest extends TestCase
{
    public function test_it_can_generate_model(): void
    {
        ModelGenerator::make(new Table('samples'))->run();

        $this->assertFileExists(Path::model().'Sample.php');
    }
}
