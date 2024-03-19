<?php

namespace Cable8mm\Xeed\Tests\Unit\Mergers;

use Cable8mm\Xeed\Mergers\TimestampsMerger;
use PHPUnit\Framework\TestCase;

final class TimestampsMergerTest extends TestCase
{
    public string $line = '$table->timestamp(\'created_at\', 0)->nullable();';

    public string $next = '$table->timestamp(\'updated_at\', 0)->nullable();';

    public string $merged = '$table->timestamps();';

    public function test_it_can_merge(): void
    {
        $merged = (new TimestampsMerger())->start($this->line, $this->next);

        $this->assertEquals($this->merged, $merged);
    }

    public function test_it_can_merge_another_field(): void
    {
        $line = '$table->timestamp(\'created_at\', 0)->nullable();';

        $next = '$table->timestamp(\'updated_at\', 0)->nullable();';

        $this->assertEquals(
            '$table->timestamps();',
            (new TimestampsMerger())->start($line, $next)
        );
    }

    public function test_it_can_not_merge(): void
    {
        $line = '$table->timestamp(\'created_at\', 0)->nullable();';

        $next = '$table->timestamp(\'updated_at\', 0);';

        $merged = (new TimestampsMerger())->start($line, $next);

        $this->assertNotEquals($this->merged, $merged);
    }
}
