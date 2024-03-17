<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * TINYTEXT
 *
 * Holds a string with a maximum length of 255 characters
 */
class TinytextResolver extends Resolver implements ResolverInterface
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
