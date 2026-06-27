<?php

namespace Cable8mm\Xeed\Laravel;

use Cable8mm\Xeed\Xeed;
use Illuminate\Support\Facades\Facade;

/**
 * @see Xeed
 */
class XeedFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'xeed';
    }
}
