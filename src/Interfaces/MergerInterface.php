<?php

namespace Cable8mm\Xeed\Interfaces;

/**
 * Merger interface.
 */
interface MergerInterface
{
    /**
     * Get a merged line from the current line and the next line.
     *
     * @param  string  $line  The current line.
     * @param  string  $next  The next line.
     * @return string|null The method return a merged line or return null on failure.
     */
    public function start(string $line, string $next): ?string;
}
