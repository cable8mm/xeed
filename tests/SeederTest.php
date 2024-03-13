<?php

namespace Cable8mm\Xeed\Tests;

use Cable8mm\Xeed\Database\Seeder;
use Cable8mm\Xeed\DB;
use PHPUnit\Framework\TestCase;

final class SeederTest extends TestCase
{
    public function test_seeder_can_make_seeds(): void
    {
        (new Seeder())->run();

        $db = DB::getInstance();

        $sql = 'SELECT * FROM '.Seeder::TABLE;

        $result = $db->query($sql);

        $users = $result->fetchAll();

        $this->assertEquals(Seeder::TOTAL, count($users));
    }
}
