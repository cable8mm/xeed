<?php

namespace Cable8mm\Xeed\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Cable8mm\Xeed\Xeed
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
