<?php

namespace Cable8mm\Xeed\Tests\Unit\Mergers;

use Cable8mm\Xeed\Generators\MigrationGenerator;
use Cable8mm\Xeed\Mergers\MergerContainer;
use Cable8mm\Xeed\Mergers\MorphsMerger;
use Cable8mm\Xeed\Mergers\NullableMorphsMerger;
use Cable8mm\Xeed\Mergers\NullableUlidMorphsMerger;
use Cable8mm\Xeed\Mergers\NullableUuidMorphsMerger;
use Cable8mm\Xeed\Mergers\TimestampsMerger;
use Cable8mm\Xeed\Mergers\UlidMorphsMerger;
use Cable8mm\Xeed\Mergers\UuidMorphsMerger;
use Cable8mm\Xeed\Support\Path;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

final class MergerContainerTest extends TestCase
{
    public array $myEngines;

    const MIGRATION_FILE = '0000_00_000000_create_xeeds_table.php';

    protected function setUp(): void
    {
        $this->myEngines = [
            new MorphsMerger(),
            new NullableMorphsMerger(),
            new NullableUlidMorphsMerger(),
            new NullableUuidMorphsMerger(),
            new TimestampsMerger(),
            new UlidMorphsMerger(),
            new UuidMorphsMerger(),
        ];
    }

    public function test_it_can_create_a_instance_with_a_file(): void
    {
        $container = MergerContainer::from(migration: Path::testBootstrap().DIRECTORY_SEPARATOR.self::MIGRATION_FILE);

        $this->assertEquals(
            Path::testBootstrap().DIRECTORY_SEPARATOR.self::MIGRATION_FILE,
            (string) $container
        );
    }

    public function test_it_can_create_a_instance_with_string(): void
    {
        $body = '            $table->string(\'morphs_type\', 255);'.PHP_EOL.'        $table->foreignId(\'morphs_id\');';

        $container = MergerContainer::from(body: $body);

        $this->assertEquals(
            $body,
            (string) $container
        );
    }

    public function test_it_can_not_create_a_instance_without_file_and_string(): void
    {
        $this->expectException(InvalidArgumentException::class);

        MergerContainer::from();
    }

    public function test_it_can_not_create_a_instance_with_both_file_and_string(): void
    {
        $this->expectException(InvalidArgumentException::class);

        MergerContainer::from(
            migration: __DIR__.'/../../../'.Path::testBootstrap().DIRECTORY_SEPARATOR.self::MIGRATION_FILE,
            body: '            $table->string(\'morphs_type\', 255);'.PHP_EOL.'        $table->foreignId(\'morphs_id\');'
        );
    }

    public function test_it_can_add_a_engine(): void
    {
        $container = MergerContainer::from(
            migration: Path::testBootstrap().DIRECTORY_SEPARATOR.self::MIGRATION_FILE
        );

        $container->engine(new MorphsMerger());

        $reflectedClass = new ReflectionClass(MergerContainer::class);
        $reflected = $reflectedClass->getProperty('engines');
        $reflected->setAccessible(true);

        $engines = $reflected->getValue($container);

        $this->assertArrayHasKey(
            0,
            $engines
        );
    }

    public function test_it_can_add_engines(): void
    {
        $container = MergerContainer::from(
            migration: Path::testBootstrap().DIRECTORY_SEPARATOR.self::MIGRATION_FILE
        );

        $container->engines($this->myEngines);

        $reflectedClass = new ReflectionClass(MergerContainer::class);
        $reflected = $reflectedClass->getProperty('engines');
        $reflected->setAccessible(true);

        $engines = $reflected->getValue($container);

        $this->assertArrayHasKey(
            count($this->myEngines) - 1,
            $engines
        );
    }

    public function test_it_can_be_operating_correctly(): void
    {
        $body = '            $table->string(\'morphs_type\', 255);'.PHP_EOL.'        $table->foreignId(\'morphs_id\');';

        $container = MergerContainer::from(body: $body);

        $migrated = $container->engines($this->myEngines)->operating()->toArray();

        $this->assertEquals(
            MigrationGenerator::INTENT.'$table->morphs(\'morphs\');',
            reset($migrated)
        );
    }
}
