<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * MULTIPOLYGON
 */
class MultiplygonResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: Implement fake() method.
        return '';
    }

    public function migration(): string
    {
        $migration = '$table->multiPolygon(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
