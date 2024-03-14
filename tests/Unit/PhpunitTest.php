<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\DB;
use PHPUnit\Framework\TestCase;

final class PhpunitTest extends TestCase
{
    public function test_received_phpunit_connection()
    {
        $this->assertContains($_ENV['DB_CONNECTION'], DB::AVAILABLE_DATABASES);
    }

    public function test_received_phpunit_database()
    {
        $this->assertNotEmpty($_ENV['DB_DATABASE']);
    }
}
