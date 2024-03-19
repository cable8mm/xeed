<?php

namespace Cable8mm\Xeed\Tests\Feature;

use Cable8mm\Xeed\Mergers\MergerContainer;
use Cable8mm\Xeed\Mergers\MorphsMerger;
use Cable8mm\Xeed\Mergers\NullableMorphsMerger;
use Cable8mm\Xeed\Mergers\NullableUlidMorphsMerger;
use Cable8mm\Xeed\Mergers\NullableUuidMorphsMerger;
use Cable8mm\Xeed\Mergers\TimestampsMerger;
use Cable8mm\Xeed\Mergers\UlidMorphsMerger;
use Cable8mm\Xeed\Mergers\UuidMorphsMerger;
use PHPUnit\Framework\TestCase;

final class PostProcessTest extends TestCase
{
    public array $myEngines;

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

    public function test_it_can_be_operating_with_nullable_morphs(): void
    {
        $body =
        // MorphsMerger
        '            $table->string(\'tests_type\', 255);'.PHP_EOL.'        $table->foreignId(\'tests_id\');'.PHP_EOL.
        // NullableMorphsMerger
        '            $table->string(\'tests_type\', 255)->nullable();'.PHP_EOL.'        $table->foreignId(\'tests_id\')->nullable();'.PHP_EOL.
        // NullableUlidMorphsMer
        '            $table->string(\'tests_type\', 255)->nullable();'.PHP_EOL.'        $table->ulid(\'tests_id\')->nullable();'.PHP_EOL.
        // NullableUuidMorphsMer
        '            $table->string(\'tests_type\', 255)->nullable();'.PHP_EOL.'        $table->uuid(\'tests_id\')->nullable();'.PHP_EOL.
        // TimestampsMerger
        '            $table->timestamp(\'created_at\', 0)->nullable();'.PHP_EOL.'        $table->timestamp(\'updated_at\', 0)->nullable();'.PHP_EOL.
        // NullableUlidMorphsMer
        '            $table->string(\'tests_type\', 255);'.PHP_EOL.'        $table->ulid(\'tests_id\');'.PHP_EOL.
        // NullableUlidMorphsMer
        '            $table->string(\'tests_type\', 255);'.PHP_EOL.'        $table->uuid(\'tests_id\');';

        $merged = [
            '$table->morphs(\'tests\');',
            '$table->nullableMorphs(\'tests\');',
            '$table->nullableUlidMorphs(\'tests\');',
            '$table->nullableUuidMorphs(\'tests\');',
            '$table->timestamps();',
            '$table->ulidMorphs(\'tests\');',
            '$table->uuidMorphs(\'tests\');',
        ];

        $migrated = MergerContainer::from(body: $body)
            ->engines($this->myEngines)
            ->operating()
            ->toArray();

        foreach ($merged as $merge) {
            $this->assertContains(
                $merge,
                $merged
            );
        }
    }
}
