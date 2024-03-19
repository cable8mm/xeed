<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->ulidMorphs() merger.
 */
class UlidMorphsMerger extends Merger
{
    private string $line = '$table->string(\'ulid_morphs_type\',255);';

    private string $next = '$table->ulid(\'ulid_morphs_id\');';

    private string $merged = '$table->ulidMorphs(\'ulid_morphs\');';

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
