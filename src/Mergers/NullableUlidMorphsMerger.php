<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->nullableUlidMorphs() merger.
 */
class NullableUlidMorphsMerger extends Merger
{
    protected string $line = '$table->string(\'{name}_type\',255)->nullable();';

    protected string $next = '$table->ulid(\'{name}_id\')->nullable();';

    protected string $merged = '$table->nullableUlidMorphs(\'{name}\');';
}
