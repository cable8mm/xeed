<?php

namespace Cable8mm\Xeed\Mergers;

use Cable8mm\Xeed\Interfaces\MergerInterface;

/**
 * Merger class.
 *
 * @internal This class should be implemented by child classes.
 */
class Merger implements MergerInterface
{
    protected string $line = '$table->string(\'{name}_type\',255);';

    protected string $next = '$table->foreignId(\'{name}_id\');';

    protected string $merged = '$table->morphs(\'{name}\');';

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
