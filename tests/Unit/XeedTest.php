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
        $xeed = Xeed::getNewInstance();

        $this->assertInstanceOf(Xeed::class, $xeed);
    }

    public function test_can_be_connected_to_database(): void
    {
        $xeed = Xeed::getInstance();

        $this->assertInstanceOf(Xeed::class, $xeed);
    }

    public function test_can_retrieve_tables(): void
    {
        $tables = Xeed::getNewInstance()->attach()->getTables();

        $this->assertNotEmpty($tables);
    }

    public function test_seeder_can_make_seeds(): void
    {
        $xeed = Xeed::getInstance();

        $sql = 'SELECT * FROM '.Seeder::TABLE;

        $result = $xeed->query($sql);

        $users = $result->fetchAll();

        $this->assertEquals(Seeder::TOTAL, count($users));
    }

    public function test_getTable_method_can_work_well(): void
    {
        $xeed = Xeed::getNewInstance()->attach();

        $table = $xeed->getTable(Seeder::TABLE);

        $this->assertEquals(Seeder::TABLE, $table);
    }
}
