<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->nullableUuidMorphs() merger.
 */
class NullableUuidMorphsMerger extends Merger
{
    protected string $line = '$table->string(\'{name}_type\',255)->nullable();';

    protected string $next = '$table->uuid(\'{name}_id\')->nullable();';

    protected string $merged = '$table->nullableUuidMorphs(\'{name}\');';
}
