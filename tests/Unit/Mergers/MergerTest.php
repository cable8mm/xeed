<?php

namespace Cable8mm\Xeed\Tests\Unit\Mergers;

use Cable8mm\Xeed\Mergers\Merger;
use PHPUnit\Framework\TestCase;

final class MergerTest extends TestCase
{
    public Merger $merger;

    protected function setUp(): void
    {
        $this->merger = new Merger();
    }

    public function test_it_can_merge(): void
    {
        $this->assertInstanceOf(Merger::class, $this->merger);
    }
}
