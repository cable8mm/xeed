<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Tests\Bootstrap\Seeder;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class XeedTest extends TestCase
{
    public function test_db_instance_can_be_created(): void
    {
        ($seeder = new Seeder())->run();

        $xeed = Xeed::getNewInstance();

        $this->assertInstanceOf(\Cable8mm\Xeed\Xeed::class, $xeed);

        $seeder->dropTables();
    }

    public function test_can_be_connected_to_database(): void
    {
        $xeed = Xeed::getInstance();

        $this->assertInstanceOf(Xeed::class, $xeed);
    }

    public function test_can_retrieve_tables(): void
    {
        $tables = Xeed::getNewInstance()->attach()->getTables();

        $this->assertIsArray($tables);
    }

    public function test_seeder_can_make_seeds(): void
    {
        ($seeder = new Seeder())->run();

        $xeed = Xeed::getInstance();

        $sql = 'SELECT * FROM '.Seeder::TABLE;

        $result = $xeed->pdo->query($sql);

        $users = $result->fetchAll();

        $seeder->dropTables();

        $this->assertEquals(Seeder::TOTAL, count($users));
    }

    public function test_getTable_method_can_work_well(): void
    {
        ($seeder = new Seeder())->run();

        $xeed = Xeed::getNewInstance()->attach();

        $table = $xeed->getTable(Seeder::TABLE);

        $this->assertEquals(Seeder::TABLE, $table);

        $seeder->dropTables();
    }
}
