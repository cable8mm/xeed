<?php

namespace Cable8mm\Xeed\Provider;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Interfaces\Provider;
use Cable8mm\Xeed\Table;

use function Cable8mm\ArrayFlatten\array_flatten;

final class SqliteProvider implements Provider
{
    public function attach(DB $db): void
    {
        $query = $db->query("SELECT name FROM sqlite_master WHERE type='table';");

        $tables = array_filter($query->fetchAll(), fn ($item) => $item['name'] !== 'sqlite_sequence');

        $tables = array_flatten($tables);

        foreach ($tables as $table) {
            $columns = $db->query('SELECT * FROM PRAGMA_TABLE_INFO("'.$table.'");')->fetchAll();

            $columns = array_flatten($columns);

            $db[$table] = new Table($table, $columns);
        }
    }
}
