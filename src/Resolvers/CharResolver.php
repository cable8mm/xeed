<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * CHAR(size)
 *
 * A FIXED length string (can contain letters, numbers, and special characters).
 * The size parameter specifies the column length in characters - can be from 0 to 255.
 * Default is 1
 */
class CharResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->randomLetter(),';
    }

    public function migration(): string
    {
        $migration = '$table->char(\''.$this->column->field.'\', '.$this->column->bracket.')';

        return $this->last($migration);
    }
}
