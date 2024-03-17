<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * GEOMETRYCOLLECTION
 */
class GeometrycollectionResolver extends Resolver implements ResolverInterface
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
