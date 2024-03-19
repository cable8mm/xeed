<?php

namespace Cable8mm\Xeed\Tests\Unit\Mergers;

use Cable8mm\Xeed\Mergers\NullableUlidMorphsMerger;
use PHPUnit\Framework\TestCase;

final class NullableUlidMorphsMergerTest extends TestCase
{
    public string $line = '$table->string(\'nullable_ulid_morphs_type\', 255)->nullable();';

    public string $next = '$table->ulid(\'nullable_ulid_morphs_id\')->nullable();';

    public string $merged = '$table->nullableUlidMorphs(\'nullable_ulid_morphs\');';

    public function test_it_can_merge(): void
    {
        $merged = (new NullableUlidMorphsMerger())->start($this->line, $this->next);

        $this->assertEquals($this->merged, $merged);
    }

    public function test_it_can_not_merge(): void
    {
        $line = '$table->timestamp(\'created_at\', 0)->nullable();';

        $next = '$table->timestamp(\'updated_at\', 0);';

        $merged = (new NullableUlidMorphsMerger())->start($line, $next);

        $this->assertNotEquals($this->merged, $merged);
    }
}
