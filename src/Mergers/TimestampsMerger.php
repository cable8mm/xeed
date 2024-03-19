<?php

namespace Cable8mm\Xeed\Mergers;

/**
 * $table->timestamps() merger.
 */
class TimestampsMerger extends Merger
{
    protected string $line = '$table->timestamp(\'created_at\',0)->nullable();';

    protected string $next = '$table->timestamp(\'updated_at\',0)->nullable();';

    protected string $merged = '$table->timestamps();';

    /**
     * {@inheritDoc}
     *
     * Timestamps is used to be matched exactly.
     */
    public function start(string $line, string $next): ?string
    {
        $line = preg_replace('/[ \t]/', '', $line);
        $next = preg_replace('/[ \t]/', '', $next);

        if ($line !== $this->line || $next !== $this->next) {
            return null;
        }

        return $this->merged;
    }
}
