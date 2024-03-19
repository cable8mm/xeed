<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->nullableMorphs() merger.
 */
class NullableMorphsMerger extends Merger
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->line = '$table->string(\'{name}_type\',255)->nullable();';
        $this->next = '$table->foreignId(\'{name}_id\')->nullable();';
        $this->merged = '$table->nullableMorphs(\'{name}\');';
    }
}
