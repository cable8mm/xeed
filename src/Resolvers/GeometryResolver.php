<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * GEOMETRY
 */
class GeometryResolver extends Resolver
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
