<?php

namespace Cable8mm\Xeed\Provider;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Interfaces\Provider;
use Cable8mm\Xeed\Table;
use PDO;

/**
 * Mysql provider can help to retrieve data from mysql database and marshalling between another fields for MySQL.
 */
final class MysqlProvider implements Provider
{
    /**
     * {@inheritDoc}
     */
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

    /**
     * {@inheritDoc}
     */
    public static function map(array $column, ?string $table = null, ?DB $db = null): array
    {
        $bracket = preg_match('/\(/', $column['Type']) ? preg_replace('/.+\(([^)]+)\)/', '\\1', $column['Type']) : null;

        $primaryKey = isset($column['Key']) && $column['Key'] == 'PRI';

        $autoIncrement = isset($column['Extra']) && preg_match('/auto_increment/', $column['Extra']);

        $notNull = isset($column['Null']) ? ($column['Null'] === 'YES') : false;

        $unsigned = preg_match('/unsigned/', $column['Extra']) !== false;

        $type = preg_replace('/[( ].+/', '', $column['Type']);

        return [
            'field' => $column['Field'],
            'type' => $type,
            'unsigned' => $unsigned,
            'autoIncrement' => $autoIncrement,
            'notNull' => $notNull,
            'primaryKey' => $primaryKey,
            'bracket' => $bracket,
            'default' => $column['Default'],
            'extra' => $column['Extra'],
        ];
    }
}
