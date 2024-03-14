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
        return '';
    }

    public function migration(): string
    {
        $migration = '$table->polygon(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
