<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * TINYTEXT
 *
 * Holds a string with a maximum length of 255 characters
 */
class TinytextResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->sentence(),';
    }

    public function migration(): string
    {
        $migration = '$table->tinyText(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
