<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->nullableUuidMorphs() merger.
 */
class NullableUuidMorphsMerger extends Merger
{
    private string $line = '$table->string(\'nullable_uuid_morphs_type\',255)->nullable();';

    private string $next = '$table->uuid(\'nullable_uuid_morphs_id\')->nullable();';

    private string $merged = '$table->nullableUuidMorphs(\'nullable_uuid_morphs\');';

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
