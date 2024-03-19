<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->morphs() merger.
 */
class MorphsMerger extends Merger
{
    protected string $line = '$table->string(\'{name}_type\',255);';

    protected string $next = '$table->foreignId(\'{name}_id\');';

    protected string $merged = '$table->morphs(\'{name}\');';
}
