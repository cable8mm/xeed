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
     * @param  \Cable8mm\Xeed\Xeed  $db  Xeed instance
     */
    public function attach(Xeed $db): void;

    /**
     * Mapping method between another fields for Database.
     *
     * @param  array  $column  Original column data
     * @param  string  $table  Table name
     * @param  Xeed  $db  Database instance
     * @return array Mapped column data
     */
    public static function map(array $column, ?string $table = null, ?Xeed $db = null): array;
}
