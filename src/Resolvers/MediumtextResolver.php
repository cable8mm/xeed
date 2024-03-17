<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * MEDIUMTEXT
 *
 * Holds a string with a maximum length of 16,777,215 characters
 */
class MediumtextResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->paragraph(),';
    }

    public function migration(): string
    {
        $migration = '$table->mediumText(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
