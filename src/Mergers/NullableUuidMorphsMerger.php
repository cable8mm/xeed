<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->nullableUuidMorphs() merger.
 */
class NullableUuidMorphsMerger extends Merger
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->line = '$table->string(\'{name}_type\',255)->nullable();';
        $this->next = '$table->uuid(\'{name}_id\')->nullable();';
        $this->merged = '$table->nullableUuidMorphs(\'{name}\');';
    }
}
