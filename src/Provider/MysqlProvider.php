<?php

namespace Cable8mm\Xeed\Provider;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Interfaces\ProviderInterface;
use Cable8mm\Xeed\ForeignKey;
use Cable8mm\Xeed\Support\Inflector;
use Cable8mm\Xeed\Table;
use Cable8mm\Xeed\Xeed;
use PDO;

/**
 * Mysql provider can help to retrieve data from mysql database and marshalling between another fields for MySQL.
 */
final class MysqlProvider implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function attach(Xeed $xeed, ?string $table = null): void
    {
        $tables = is_null($table)
            ? $xeed->pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN)
            : [$table];

        foreach ($tables as $table)
        {
            $columns = $xeed->pdo->query('SHOW COLUMNS FROM ' . $table)->fetchAll(PDO::FETCH_ASSOC);

            $foreignKeys = $xeed->pdo->query('SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = "' . $table . '" AND TABLE_SCHEMA = "' . $_ENV['DB_DATABASE'] . '" AND REFERENCED_TABLE_NAME IS NOT NULL')->fetchAll(PDO::FETCH_ASSOC);

            $foreignKeys = array_map(
                fn (array $key) => new ForeignKey(...self::mapForeignKeys($key)),
                $foreignKeys
            );

            $tableColumns = array_map(
                fn (array $column) => new Column(...self::map($column)),
                $columns
            );

            $xeed[$table] = new Table($table, $tableColumns, $foreignKeys);
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function mapForeignKeys(array $foreignKey): array
    {
        return [
            'name' => $foreignKey['CONSTRAINT_NAME'],
            'table' => Inflector::classify($foreignKey['TABLE_NAME']),
            'column' => $foreignKey['COLUMN_NAME'],
            'referenced_table' => Inflector::classify($foreignKey['REFERENCED_TABLE_NAME']),
            'referenced_column' => $foreignKey['REFERENCED_COLUMN_NAME'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function map(array $column, ?string $table = null, ?Xeed $xeed = null): array
    {
        $bracket = preg_match('/\(/', $column['Type']) ? preg_replace('/.+\(([^)]+)\)/', '\\1', $column['Type']) : null;

        $primaryKey = isset($column['Key']) && $column['Key'] == 'PRI';

        $autoIncrement = isset($column['Extra']) && preg_match('/auto_increment/', $column['Extra']);

        $notNull = isset($column['Null']) ? ($column['Null'] === 'NO') : false;

        $unsigned = (bool) preg_match('/unsigned/', $column['Type']);

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
