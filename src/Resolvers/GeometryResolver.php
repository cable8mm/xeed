<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * GEOMETRY
 */
class GeometryResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        // TODO: Understanding GEOMETRY, then implement this method for it
        return '\''.$this->column->field.'\' => fake()->numerify(),';
    }

    public function migration(): string
    {
        $migration = '$table->geometry(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
