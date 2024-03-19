<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->uuidMorphs() merger.
 */
class UuidMorphsMerger extends Merger
{
    protected string $line = '$table->string(\'{name}_type\',255);';

    protected string $next = '$table->uuid(\'{name}_id\');';

    protected string $merged = '$table->uuidMorphs(\'{name}\');';
}
