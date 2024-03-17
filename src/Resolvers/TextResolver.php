<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * TEXT(size)
 *
 * Holds a string with a maximum length of 65,535 bytes
 */
class TextResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->paragraph(),';
    }

    public function migration(): string
    {
        $migration = '$table->text(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
