<?php

namespace Cable8mm\Xeed\Tests;

use PHPUnit\Framework\TestCase;

final class PhpunitTest extends TestCase
{
    public function test_received_phpunit_connection()
    {
        $this->assertEquals('sqlite', $_ENV['DB_CONNECTION']);
    }

    public function test_received_phpunit_database()
    {
        $this->assertEquals('database/database.sqlite', $_ENV['DB_DATABASE']);
    }
}
