<?php

namespace Cable8mm\Xeed\Tests;

use Cable8mm\Xeed\Database\Seeder;
use Cable8mm\Xeed\DB;
use PHPUnit\Framework\TestCase;

final class DBTest extends TestCase
{
    protected function setUp(): void
    {
        (new Seeder())->run();
    }

    public function test_can_be_connected_to_memory(): void
    {
        $this->expectNotToPerformAssertions();

        $db = DB::newGetInstance();
    }

    public function test_can_retrieve_tables(): void
    {
        $tables = DB::newGetInstance()->attach()->getTables();

        $this->assertNotEmpty($tables);
    }

    public function test_can_be_inspected_into_columns(): void
    {
        $columns = DB::getInstance()->attach()[Seeder::TABLE];

        $this->assertNotEmpty($columns);
    }
}
