<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Database\Seeder;
use Cable8mm\Xeed\DB;
use PHPUnit\Framework\TestCase;

final class SeederTest extends TestCase
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

    public function test_seeder_can_make_seeds(): void
    {
        $db = DB::getInstance();

        $sql = 'SELECT * FROM '.Seeder::TABLE;

        $result = $db->query($sql);

        $users = $result->fetchAll();

        $this->assertEquals(Seeder::TOTAL, count($users));
    }
}
