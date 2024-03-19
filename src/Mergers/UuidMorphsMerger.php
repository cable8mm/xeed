<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->uuidMorphs() merger.
 */
class UuidMorphsMerger extends Merger
{
    private string $line = '$table->string(\'uuid_morphs_type\',255);';

    private string $next = '$table->uuid(\'uuid_morphs_id\');';

    private string $merged = '$table->uuidMorphs(\'uuid_morphs\');';

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
