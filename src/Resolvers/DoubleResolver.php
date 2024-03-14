<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * DOUBLE(size, d)
 *
 * A normal-size floating point number.
 * The total number of digits is specified in size.
 * The number of digits after the decimal point is specified in the d parameter
 */
class DoubleResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->randomFloat(),';
    }

    public function migration(): string
    {
        // TODO: $table->double('amount', 8, 2);
        $migration = '$table->double(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
