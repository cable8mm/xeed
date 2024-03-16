<?php

namespace Cable8mm\Xeed\Interfaces;

use Cable8mm\Xeed\DB;

/**
 * Provider interface.
 */
interface Provider
{
    /**
     * To attach child provider to DB instance.
     *
     * @param  \Cable8mm\Xeed\DB  $db  DB instance
     */
    public function attach(DB $db): void;

    /**
     * Mapping method between another fields for Database.
     *
     * @param  array  $column  Original column data
     * @param  string  $table  Table name
     * @param  DB  $db  Database instance
     * @return array Mapped column data
     */
    public static function map(array $column, ?string $table = null, ?DB $db = null): array;
}
