<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * MULTIPOLYGON
 */
class MultipolygonResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => \'MULTIPOLYGON(((0 0,10 0,10 10,0 10,0 0)),((5 5,7 5,7 7,5 7, 5 5)))\',';
    }

    public function migration(): string
    {
        $migration = '$table->multiPolygon(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
