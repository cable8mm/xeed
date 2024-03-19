<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->morphs() merger.
 */
class MorphsMerger extends Merger
{
    private string $line = '$table->string(\'morphs_type\',255);';

    private string $next = '$table->foreignId(\'morphs_id\');';

    private string $merged = '$table->morphs(\'morphs\');';

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
