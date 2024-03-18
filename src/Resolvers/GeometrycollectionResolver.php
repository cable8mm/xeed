<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * GEOMETRYCOLLECTION
 */
class GeometrycollectionResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: Understanding GEOMETRYCOLLECTION, then implement this method for it
        return '\''.$this->column->field.'\' => fake()->numerify(),';
    }

    public function migration(): string
    {
        $migration = '$table->geometryCollection(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
