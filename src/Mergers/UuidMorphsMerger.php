<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->uuidMorphs() merger.
 */
class UuidMorphsMerger extends Merger
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->line = '$table->string(\'{name}_type\',255);';
        $this->next = '$table->uuid(\'{name}_id\');';
        $this->merged = '$table->uuidMorphs(\'{name}\');';
    }
}
