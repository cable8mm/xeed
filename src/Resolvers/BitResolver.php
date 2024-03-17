<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * BIT(size)
 *
 * A bit-value type.
 * The number of bits per value is specified in size.
 * The size parameter can hold a value from 1 to 64.
 * The default value for size is 1.
 */
final class BitResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->numberBetween(1, 64),';
    }

    public function migration(): string
    {
        $migration = '$table->integer(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
