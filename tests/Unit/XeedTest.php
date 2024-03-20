<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Tests\Bootstrap\Seeder;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class XeedTest extends TestCase
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
        $db = Xeed::getNewInstance();

        $this->assertInstanceOf(Xeed::class, $db);
    }

    public function test_can_be_connected_to_database(): void
    {
        $db = Xeed::getInstance();

        $this->assertInstanceOf(Xeed::class, $db);
    }

    public function test_can_retrieve_tables(): void
    {
        $tables = Xeed::getNewInstance()->attach()->getTables();

        $this->assertNotEmpty($tables);
    }

    public function test_seeder_can_make_seeds(): void
    {
        $db = Xeed::getInstance();

        $sql = 'SELECT * FROM '.Seeder::TABLE;

        $result = $db->query($sql);

        $users = $result->fetchAll();

        $this->assertEquals(Seeder::TOTAL, count($users));
    }

    public function test_getTable_method_can_work_well(): void
    {
        $db = Xeed::getNewInstance()->attach();

        $table = $db->getTable(Seeder::TABLE);

        $this->assertEquals(Seeder::TABLE, $table);
    }
}
