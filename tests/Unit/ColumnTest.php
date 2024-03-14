<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Provider\MysqlProvider;
use Cable8mm\Xeed\Provider\SqliteProvider;
use PHPUnit\Framework\TestCase;

final class ColumnTest extends TestCase
{
    public function test_it_make_column_from_mysql(): void
    {
        $mysqlColumn = [
            'Field' => 'name',
            'Type' => 'varchar(25)',
            'Key' => '',
            'Default' => 1,
            'Extra' => 1,
        ];

        $columns = new Column(...MysqlProvider::map($mysqlColumn));

        $this->assertEquals('name', $columns->field);
        $this->assertEquals('varchar', $columns->type);
        $this->assertEquals(25, $columns->bracket);
        $this->assertEquals('1', $columns->default);
        $this->assertEquals('1', $columns->extra);
    }

    public function test_it_make_column_from_sqlite(): void
    {
        $sqliteColumn = [
            'cid' => 1,
            '0' => 1,
            'name' => 'name',
            '1' => 'name',
            'type' => 'VARCHAR(25)',
            '2' => 'VARCHAR(25)',
            'notnull' => 1,
            '3' => 1,
            'dflt_value' => '',
            '4' => '',
            'pk' => 0,
            '5' => 0,
        ];

        $columns = new Column(...SqliteProvider::map($sqliteColumn));

        $this->assertEquals('name', $columns->field);
        $this->assertEquals('varchar', $columns->type);
        $this->assertEquals(25, $columns->bracket);
        $this->assertEquals('', $columns->default);
    }
}
