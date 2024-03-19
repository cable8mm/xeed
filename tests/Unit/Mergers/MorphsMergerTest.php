<?php

namespace Cable8mm\Xeed\Tests\Unit\Mergers;

use Cable8mm\Xeed\Mergers\MorphsMerger;
use PHPUnit\Framework\TestCase;

final class MorphsMergerTest extends TestCase
{
    public string $line = '$table->string(\'morphs_type\', 255);';

    public string $next = '$table->foreignId(\'morphs_id\');';

    public string $merged = '$table->morphs(\'morphs\');';

    public function test_it_can_merge(): void
    {
        $merged = (new MorphsMerger())->start($this->line, $this->next);

        $this->assertEquals($this->merged, $merged);
    }

    public function test_it_can_merge_another_field(): void
    {
        $line = '$table->string(\'another_fields_type\', 255);';

        $next = '$table->foreignId(\'another_fields_id\');';

        $this->assertEquals(
            '$table->morphs(\'another_fields\');',
            (new MorphsMerger())->start($line, $next)
        );
    }

    public function test_it_can_not_merge(): void
    {
        $line = '$table->timestamp(\'created_at\', 0)->nullable();';

        $next = '$table->timestamp(\'updated_at\', 0);';

        $merged = (new MorphsMerger())->start($line, $next);

        $this->assertNotEquals($this->merged, $merged);
    }
}
