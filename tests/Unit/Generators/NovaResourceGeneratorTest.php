<?php

namespace Cable8mm\Xeed\Tests\Unit\Generators;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Generators\NovaResourceGenerator;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;
use PHPUnit\Framework\TestCase;

final class NovaResourceGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        NovaResourceGenerator::make(
            new Table('samples', [
                Column::make('id', 'bigint'),
                Column::make('name', 'varchar'),
                Column::make('created_at', 'timestamp'),
                Column::make('updated_at', 'timestamp'),
            ]),
            destination: Path::testgen()
        )->run();
    }

    protected function tearDown(): void
    {
        File::system()->delete(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');
    }

    public function test_it_can_be_existed(): void
    {
        $this->assertFileExists(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');
    }

    public function test_it_can_be_without_timestamps(): void
    {
        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        $this->assertStringNotContainsString('Created At', $file);
        $this->assertStringNotContainsString('Updated At', $file);
    }

    public function test_it_can_generate_class_uses_and_fields(): void
    {
        $file = File::system()->read(Path::testgen().DIRECTORY_SEPARATOR.'Sample.php');

        $this->assertStringContainsString('use Laravel\\Nova\\Fields\\ID;', $file);
        $this->assertStringContainsString('use Laravel\\Nova\\Fields\\Text;', $file);
        $this->assertStringContainsString('public function fields(NovaRequest $request)', $file);
        $this->assertStringContainsString('Text::make(\'Name\')', $file);
        $this->assertStringContainsString('ID::make()->sortable()', $file);
        $this->assertStringContainsString('public static $title = \'Samples\';', $file);
    }
}
