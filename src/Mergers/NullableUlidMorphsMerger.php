<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->nullableUlidMorphs() merger.
 */
class NullableUlidMorphsMerger extends Merger
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->line = '$table->string(\'{name}_type\',255)->nullable();';
        $this->next = '$table->ulid(\'{name}_id\')->nullable();';
        $this->merged = '$table->nullableUlidMorphs(\'{name}\');';
    }
}
