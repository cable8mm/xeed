<?php

namespace Cable8mm\Xeed\Mergers;

use Cable8mm\Xeed\Interfaces\MergerInterface;
use LogicException;

/**
 * Merger class.
 *
 * @internal This class should be implemented by child classes.
 */
class Merger implements MergerInterface
{
    /**
     * {@inheritDoc}
     *
     * @throw LogicException
     */
    public function start(string $line, string $next): ?string
    {
        throw new LogicException(__METHOD__.' Method not implemented.');
    }
}
