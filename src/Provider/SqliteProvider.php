<?php

namespace Cable8mm\Xeed\Provider;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Interfaces\ProviderInterface;
use Cable8mm\Xeed\Table;
use Cable8mm\Xeed\Xeed;

use function Cable8mm\ArrayFlatten\array_flatten;

/**
 * SQLite provider can help to retrieve data from sqlite database and marshalling between another fields for SQLite.
 */
final class SqliteProvider implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function attach(Xeed $xeed, ?string $table = null): void
    {
        if (is_null($table)) {
            $query = $xeed->pdo->query("SELECT name FROM sqlite_master WHERE type='table';");

            $tables = array_filter($query->fetchAll(), fn ($item) => $item['name'] !== 'sqlite_sequence');

            $tables = array_flatten($tables);
        } else {
            $tables = [$table];
        }

        foreach ($tables as $table) {
            $columns = $xeed->pdo->query('SELECT * FROM PRAGMA_TABLE_INFO("'.$table.'");')->fetchAll();

            foreach ($columns as $column) {
                $columnObject[] = new Column(...self::map($column, $table, $xeed));
            }

            $xeed[$table] = new Table($table, $columnObject);
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function map(array $column, ?string $table = null, ?Xeed $xeed = null): array
    {
        $authIncrement = false;

        if ($column['pk'] == 1) {
            $count = $xeed->pdo->query('SELECT COUNT(*) FROM sqlite_sequence WHERE name=\''.$table.'\'');
            $authIncrement = $count == 1;
        }

        return [
            'field' => $column['name'],
            'type' => preg_match('/\(/', $column['type']) ? preg_replace('/\(.+/', '', $column['type']) : $column['type'],
            'unsigned' => false,
            'autoIncrement' => $authIncrement,
            'notNull' => $column['notnull'] == 1,
            'primaryKey' => $column['pk'] == 1,
            'bracket' => preg_match('/\(/', $column['type']) ? (int) preg_replace('/.+\(([0-9]+)\)/', '\\1', $column['type']) : null,
            'default' => $column['dflt_value'],
            'extra' => null,
        ];
    }
}
