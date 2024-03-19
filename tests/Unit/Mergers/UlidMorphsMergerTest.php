<?php

namespace Cable8mm\Xeed\Tests\Unit\Mergers;

use Cable8mm\Xeed\Mergers\UlidMorphsMerger;
use PHPUnit\Framework\TestCase;

final class UlidMorphsMergerTest extends TestCase
{
    public string $line = '$table->string(\'ulid_morphs_type\', 255);';

    public string $next = '$table->ulid(\'ulid_morphs_id\');';

    public string $merged = '$table->ulidMorphs(\'ulid_morphs\');';

    public function test_it_can_merge(): void
    {
        $merged = (new UlidMorphsMerger())->start($this->line, $this->next);

        $this->assertEquals($this->merged, $merged);
    }

    public function test_it_can_not_merge(): void
    {
        $line = '$table->timestamp(\'created_at\', 0)->nullable();';

        $next = '$table->timestamp(\'updated_at\', 0);';

        $merged = (new UlidMorphsMerger())->start($line, $next);

        $this->assertNotEquals($this->merged, $merged);
    }
}
