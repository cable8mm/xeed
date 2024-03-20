<?php

namespace Cable8mm\Xeed\Interfaces;

use Cable8mm\Xeed\Xeed;

/**
 * Provider interface.
 */
interface ProviderInterface
{
    /**
     * To attach child provider to DB instance.
     *
     * @param  \Cable8mm\Xeed\Xeed  $xeed  Xeed instance
     */
    public function attach(Xeed $xeed): void;

    /**
     * Mapping method between another fields for Database.
     *
     * @param  array  $column  Original column data
     * @param  string  $table  Table name
     * @param  Xeed  $xeed  Database instance
     * @return array Mapped column data
     */
    public static function map(array $column, ?string $table = null, ?Xeed $xeed = null): array;
}
