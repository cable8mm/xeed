<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * POLYGON
 */
class PolygonResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        // TODO: Implement fake() method.
        return '\''.$this->column->field.'\' => \'POLYGON((0 0,10 0,10 10,0 10,0 0),(5 5,7 5,7 7,5 7, 5 5))\',';
    }

    public function migration(): string
    {
        $migration = '$table->polygon(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
