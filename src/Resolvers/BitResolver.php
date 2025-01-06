<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * BIT(size)
 *
 * A bit-value type.
 * The number of bits per value is specified in size.
 * The size parameter can hold a value from 1 to 64.
 * The default value for size is 1.
 */
final class BitResolver extends Resolver
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

    public function nova(): ?string
    {
        return 'Boolean::make(\''.Inflector::title($this->column->field).'\'),';
    }

    public function cast(): ?string
    {
        return 'boolean';
    }
}
