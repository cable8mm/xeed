<?php

namespace Cable8mm\Xeed\Provider;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Interfaces\Provider;
use Cable8mm\Xeed\Table;
use PDO;

final class MysqlProvider implements Provider
{
    public function attach(DB $db): void
    {
        $tables = $db->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

        foreach ($tables as $table) {
            $columns = $db->query('SHOW COLUMNS FROM '.$table)->fetchAll(PDO::FETCH_ASSOC);

            $tableColumns = array_map(
                fn (array $column) => new Column(...self::map($column)),
                $columns
            );

            $db[$table] = new Table($table, $tableColumns);
        }
    }

    public static function map(array $column): array
    {
        return [
            'field' => $column['Field'],
            'nullable' => isset($column['Null']) ? ($column['Null'] === 'YES') : false,
            'key' => $column['Key'] != '',
            'default' => $column['Default'],
            'extra' => $column['Extra'],
            'type' => preg_match('/\(/', $column['Type']) ? preg_replace('/\(.+/', '', $column['Type']) : $column['Type'],
            'bracket' => preg_match('/\(/', $column['Type']) ? (int) preg_replace('/.+\(([0-9]+)\)/', '\\1', $column['Type']) : null,
        ];
    }
}
