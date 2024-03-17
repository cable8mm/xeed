<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * CHAR(size)
 *
 * A FIXED length string (can contain letters, numbers, and special characters).
 * The size parameter specifies the column length in characters - can be from 0 to 255.
 * Default is 1
 */
class CharResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->randomLetter(),';
    }

    public function migration(): string
    {
        $migration = empty($this->column->bracket) ?
            '$table->char(\''.$this->column->field.'\')' :
            '$table->char(\''.$this->column->field.'\', '.$this->column->bracket.')';

        return $this->last($migration);
    }
}
