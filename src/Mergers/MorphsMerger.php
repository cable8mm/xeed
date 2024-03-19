<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->morphs() merger.
 */
class MorphsMerger extends Merger
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->line = '$table->string(\'{name}_type\',255);';
        $this->next = '$table->foreignId(\'{name}_id\');';
        $this->merged = '$table->morphs(\'{name}\');';
    }
}
