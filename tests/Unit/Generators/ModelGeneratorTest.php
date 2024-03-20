<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Generators\ModelGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class ModelGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        ModelGenerator::make(
            new Table('samples'),
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->delete(Path::testgen().'Sample.php');
    }

    public function test_it_can_generate_model_file(): void
    {
        $this->assertFileExists(__DIR__.'/../../../'.Path::testgen().'Sample.php');
    }
}
