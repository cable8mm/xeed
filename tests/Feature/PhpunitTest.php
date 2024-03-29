<?php

namespace Cable8mm\Xeed\Tests\Feature;

use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class PhpunitTest extends TestCase
{
    protected function setUp(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
        $dotenv->safeLoad();
    }

    public function test_received_phpunit_connection()
    {
        $this->assertContains($_ENV['DB_CONNECTION'], Xeed::AVAILABLE_DATABASES);
    }

    public function test_received_phpunit_database()
    {
        $this->assertNotEmpty($_ENV['DB_DATABASE']);
    }
}
