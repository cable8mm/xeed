<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * POLYGON
 */
class PolygonResolver extends Resolver
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
