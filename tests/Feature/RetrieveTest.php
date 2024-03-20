<?php

namespace Cable8mm\Xeed\Tests\Feature;

use Cable8mm\Xeed\Tests\Bootstrap\Seeder;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class RetrieveTest extends TestCase
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

    public function test_can_be_inspected_into_columns(): void
    {
        $columns = Xeed::getInstance()->attach()->getTable(Seeder::TABLE)->getColumns();

        $this->assertIsArray($columns);
    }

    public function test_can_be_inspected_into_tables(): void
    {
        $tables = Xeed::getInstance()->attach()->getTables();

        $this->assertIsArray($tables);
    }
}
