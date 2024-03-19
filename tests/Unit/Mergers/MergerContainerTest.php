<?php

namespace Cable8mm\Xeed\Tests\Unit\Mergers;

use Cable8mm\Xeed\Mergers\MergerContainer;
use Cable8mm\Xeed\Support\Path;
use PHPUnit\Framework\TestCase;

final class MergerContainerTest extends TestCase
{
    public function test_it_can_create_a_instance(): void
    {
        $container = MergerContainer::from(migration: Path::testBootstrap().'migration.php.sample');

        $this->assertEquals(Path::testBootstrap().'migration.php.sample', (string) $container);
    }
}
