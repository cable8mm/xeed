<?php

namespace Cable8mm\Xeed\Tests\Unit\Mergers;

use Cable8mm\Xeed\Mergers\UuidMorphsMerger;
use PHPUnit\Framework\TestCase;

final class UuidMorphsMergerTest extends TestCase
{
    public string $line = '$table->string(\'uuid_morphs_type\', 255);';

    public string $next = '$table->uuid(\'uuid_morphs_id\');';

    public string $merged = '$table->uuidMorphs(\'uuid_morphs\');';

    public function test_it_can_merge(): void
    {
        $merged = (new UuidMorphsMerger())->start($this->line, $this->next);

        $this->assertEquals($this->merged, $merged);
    }

    public function test_it_can_not_merge(): void
    {
        $line = '$table->timestamp(\'created_at\', 0)->nullable();';

        $next = '$table->timestamp(\'updated_at\', 0);';

        $merged = (new UuidMorphsMerger())->start($line, $next);

        $this->assertNotEquals($this->merged, $merged);
    }
}
