<?php

namespace Cable8mm\Xeed\Interfaces;

use Cable8mm\Xeed\Xeed;

/**
 * Provider interface.
 */
interface ProviderInterface
{
    /**
     * Attach child provider to DB instance.
     *
     * @param  \Cable8mm\Xeed\Xeed  $xeed  Xeed instance
     * @param  string  $table  The table name to attach child provider
     */
    public function attach(Xeed $xeed, ?string $table = null): void;

    /**
     * Do mapping method between another fields for Database.
     *
     * @param  array  $column  Original column data
     * @param  string  $table  Table name
     * @param  Xeed  $xeed  Database instance
     * @return array The method returns mapped column data
     */
    public static function map(array $column, ?string $table = null, ?Xeed $xeed = null): array;
}
