<?php

namespace Cable8mm\Xeed\Interfaces;

/**
 * Merger interface.
 */
interface MergerInterface
{
    /**
     * To get a merged line from the current line and the next line.
     *
     * @param  string  $line  The current line.
     * @param  string  $next  The next line.
     * @return string|null The merged line. If it's not matched, return null.
     */
    public function start(string $line, string $next): ?string;
}
