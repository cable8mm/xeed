<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->nullableMorphs() merger.
 */
class NullableMorphsMerger extends Merger
{
    protected string $line = '$table->string(\'{name}_type\',255)->nullable();';

    protected string $next = '$table->foreignId(\'{name}_id\')->nullable();';

    protected string $merged = '$table->nullableMorphs(\'{name}\');';
}
