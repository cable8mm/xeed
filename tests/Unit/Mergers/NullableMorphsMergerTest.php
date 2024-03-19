<?php

namespace Cable8mm\Xeed\Tests\Unit\Mergers;

use Cable8mm\Xeed\Mergers\NullableMorphsMerger;
use PHPUnit\Framework\TestCase;

final class NullableMorphsMergerTest extends TestCase
{
    public string $line = '$table->string(\'nullable_morphs_type\', 255)->nullable();';

    public string $next = '$table->foreignId(\'nullable_morphs_id\')->nullable();';

    public string $merged = '$table->nullableMorphs(\'nullable_morphs\');';

    public function test_it_can_merge(): void
    {
        $merged = (new NullableMorphsMerger())->start($this->line, $this->next);

        $this->assertEquals($this->merged, $merged);
    }

    public function test_it_can_not_merge(): void
    {
        $line = '$table->timestamp(\'created_at\', 0)->nullable();';

        $next = '$table->timestamp(\'updated_at\', 0);';

        $merged = (new NullableMorphsMerger())->start($line, $next);

        $this->assertNotEquals($this->merged, $merged);
    }
}
