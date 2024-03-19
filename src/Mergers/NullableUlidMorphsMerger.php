<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->nullableUlidMorphs() merger.
 */
class NullableUlidMorphsMerger extends Merger
{
    private string $line = '$table->string(\'nullable_ulid_morphs_type\',255)->nullable();';

    private string $next = '$table->ulid(\'nullable_ulid_morphs_id\')->nullable();';

    private string $merged = '$table->nullableUlidMorphs(\'nullable_ulid_morphs\');';

    /**
     * {@inheritDoc}
     */
    public function start(string $line, string $next): ?string
    {
        $line = preg_replace('/[ \t]/', '', $line);
        $next = preg_replace('/[ \t]/', '', $next);

        if ($line === $this->line && $next === $this->next) {
            return $this->merged;
        }

        return null;
    }
}
