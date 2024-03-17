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
        $db = DB::getNewInstance();

        $this->assertInstanceOf(DB::class, $db);
    }

    public function test_can_be_connected_to_database(): void
    {
        $db = DB::getInstance();

        $this->assertInstanceOf(DB::class, $db);
    }

    public function test_can_retrieve_tables(): void
    {
        $tables = DB::getNewInstance()->attach()->getTables();

        $this->assertNotEmpty($tables);
    }

    public function test_seeder_can_make_seeds(): void
    {
        $db = DB::getInstance();

        $sql = 'SELECT * FROM '.Seeder::TABLE;

        $result = $db->query($sql);

        $users = $result->fetchAll();

        $this->assertEquals(Seeder::TOTAL, count($users));
    }

    public function test_getTable_method_can_work_well(): void
    {
        $db = DB::getNewInstance()->attach();

        $table = $db->getTable(Seeder::TABLE);

        $this->assertEquals(Seeder::TABLE, $table->getName());
    }

    // public function test_getTable_method_can_work_well_for_xeeds_table(): void
    // {
    //     $db = DB::getNewInstance()->attach();

    //     $table = $db->getTable('xeeds');

    //     $this->assertEquals('xeeds', $table->getName());
    // }
}
