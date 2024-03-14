<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Database\Seeder;
use Cable8mm\Xeed\DB;
use PHPUnit\Framework\TestCase;

final class DBTest extends TestCase
{
    private Seeder $seeder;

    protected function setUp(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
        $dotenv->safeLoad();

        $this->seeder = new Seeder();

        $this->seeder->run();
    }

    protected function tearDown(): void
    {
        $this->seeder->dropTables();
    }

    public function test_db_instance_can_be_created(): void
    {
        $db = DB::newGetInstance();

        $this->assertInstanceOf(DB::class, $db);
    }

    public function test_can_be_connected_to_database(): void
    {
        $db = DB::getInstance();

        $this->assertInstanceOf(DB::class, $db);
    }

    public function test_can_retrieve_tables(): void
    {
        $tables = DB::newGetInstance()->attach()->getTables();

        $this->assertNotEmpty($tables);
    }
}
