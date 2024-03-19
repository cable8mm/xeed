<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->ulidMorphs() merger.
 */
class UlidMorphsMerger extends Merger
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->line = '$table->string(\'{name}_type\',255);';
        $this->next = '$table->ulid(\'{name}_id\');';
        $this->merged = '$table->ulidMorphs(\'{name}\');';
    }
}
