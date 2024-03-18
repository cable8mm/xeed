<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Types\Bracket;

/**
 * VARCHAR(size)
 *
 * A VARIABLE length string (can contain letters, numbers, and special characters).
 * The size parameter specifies the maximum column length in characters - can be from 0 to 65535
 */
class VarcharResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->paragraph(),';
    }

    public function migration(): string
    {
        $bracket = Bracket::of($this->column->bracket)->escape();

        $migration = '$table->string(\''.$this->column->field.'\', '.$bracket.')';

        return $this->last($migration);
    }
}
