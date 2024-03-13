<?php

namespace Cable8mm\Xeed\Provider;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Interfaces\Provider;
use Cable8mm\Xeed\Table;
use PDO;

final class MysqlProvider implements Provider
{
    public function attach(DB $db): void
    {
        array_map(
            fn ($item) => $db[$item] = new Table(
                $item,
                $db->query('SHOW COLUMNS FROM '.$item)->fetchAll(PDO::FETCH_ASSOC)
            ),
            $db->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN)
        );
    }

    public static function map(array $column): array
    {
        return [
            'field' => $column['Field'],
            'null' => $column['Type'],
            'key' => $column['Key'],
            'default' => $column['Default'],
            'extra' => $column['Extra'],
            'type' => preg_match('/(/', $column['Type']) ? preg_replace('/\(.+?/', '', $column['Type']) : $column['Type'],
            'bracket' => preg_match('/(/', $column['Type']) ? (int) preg_replace('/.+\((.+)\).+?/', '\\1', $column['Type']) : null,
        ];
    }
}
