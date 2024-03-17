<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * BOOL
 *
 * Zero is considered as false, nonzero values are considered as true.
 */
class BoolResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->boolean(),';
    }

    public function migration(): string
    {
        $migration = '$table->boolean(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
