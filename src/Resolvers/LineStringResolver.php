<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * LINESTRING
 */
class LineStringResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: Implement fake() method.
        return '\''.$this->column->field.'\' => fake()->numerify(),';
    }

    public function migration(): string
    {
        $migration = '$table->lineString(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
