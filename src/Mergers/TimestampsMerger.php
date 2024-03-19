<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->timestamps() merger.
 */
class TimestampsMerger extends Merger
{
    private string $line = '$table->timestamp(\'created_at\',0)->nullable();';

    private string $next = '$table->timestamp(\'updated_at\',0)->nullable();';

    private string $merged = '$table->timestamps();';

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
