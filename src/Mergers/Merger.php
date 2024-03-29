<?php

namespace Cable8mm\Xeed\Mergers;

use Cable8mm\Xeed\Interfaces\MergerInterface;

/**
 * Merger abstract class.
 */
abstract class Merger implements MergerInterface
{
    /**
     * On going merge the first line
     */
    protected string $line;

    /**
     * On going merge the second line
     */
    protected string $next;

    /**
     * Final merge result
     */
    protected string $merged;

    /**
     * $line, $next and $merged variables were set.
     */
    abstract public function __construct();

    /**
     * {@inheritDoc}
     */
    public function start(string $line, string $next): ?string
    {
        $line = preg_replace('/[ \t]/', '', $line);
        $next = preg_replace('/[ \t]/', '', $next);

        $linePattern = self::getPattern($this->line);
        $nextPattern = self::getPattern($this->next);

        if (! preg_match($linePattern, $line, $lineMatches) || ! preg_match($nextPattern, $next, $nextMatches)) {
            return null;
        }

        if ($lineMatches[1] !== $nextMatches[1]) {
            return null;
        }

        return str_replace(
            ['{name}'],
            [$lineMatches[1]],
            $this->merged
        );

        return null;
    }

    private static function getPattern(string $name): string
    {
        return '/'.str_replace(
            ['$', '(', ')', '{name}'],
            ['\$', '\(', '\)', '([a-zA-Z-_ ]+)'],
            $name
        ).'/';
    }
}
