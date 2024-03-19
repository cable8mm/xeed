<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->ulidMorphs() merger.
 */
class UlidMorphsMerger extends Merger
{
    protected string $line = '$table->string(\'{name}_type\',255);';

    protected string $next = '$table->ulid(\'{name}_id\');';

    protected string $merged = '$table->ulidMorphs(\'{name}\');';
}
