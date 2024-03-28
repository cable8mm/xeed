<?php

namespace Cable8mm\Xeed\Provider;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Interfaces\ProviderInterface;
use Cable8mm\Xeed\Table;
use Cable8mm\Xeed\Xeed;
use PDO;

/**
 * PostgreSQL provider can help to retrieve data from mysql database and marshalling between another fields for PostgreSQL.
 */
final class PgsqlProvider implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function attach(Xeed $xeed, ?string $table = null): void
    {
        $tables = is_null($table)
            ? $xeed->pdo->query('SELECT table_name FROM information_schema.tables WHERE table_schema = \'public\' ORDER BY table_name')->fetchAll(PDO::FETCH_COLUMN)
            : [$table];

        $tables = array_diff($tables, [
            'geography_columns',
            'geometry_columns',
            'spatial_ref_sys',
        ]);

        foreach ($tables as $table) {
            $columns = $xeed->pdo->query('SELECT * FROM information_schema.columns WHERE table_schema = \'public\' AND table_name = \''.$table.'\'')->fetchAll(PDO::FETCH_ASSOC);

            try {
                $primaryKeys = $xeed->pdo->query('SELECT a.attname AS column_name FROM pg_index i JOIN pg_attribute a ON a.attrelid = i.indrelid AND a.attnum = ANY(i.indkey) WHERE i.indrelid = \''.$table.'\'::regclass AND i.indisprimary')->fetchAll(PDO::FETCH_COLUMN);
            } catch (\PDOException $e) {
                $primaryKeys = [];
            }

            $tableColumns = array_map(
                function (array $column) use ($primaryKeys) {

                    $column['primary_key'] = in_array($column['column_name'], $primaryKeys);

                    return new Column(...self::map($column));
                },
                $columns
            );

            $xeed[$table] = new Table($table, $tableColumns);
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function map(array $column, ?string $table = null, ?Xeed $xeed = null): array
    {
        $bracket = ! empty($column['numeric_precision']) ? '('.$column['numeric_precision'].', '.$column['numeric_precision_radix'].')' : null;

        $primaryKey = $column['primary_key'];

        $autoIncrement = isset($column['column_default']) ? str_contains($column['column_default'], 'nextval') : false;

        $notNull = $column['is_nullable'] === 'NO';

        $unsigned = false;

        $type = $column['data_type'];

        return [
            'field' => $column['column_name'],
            'type' => $type,
            'unsigned' => $unsigned,
            'autoIncrement' => $autoIncrement,
            'notNull' => $notNull,
            'primaryKey' => $primaryKey,
            'bracket' => $bracket,
            'default' => $column['column_default'],
            'extra' => null,
        ];
    }
}
