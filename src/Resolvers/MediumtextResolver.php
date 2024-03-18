<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * MEDIUMTEXT
 *
 * Holds a string with a maximum length of 16,777,215 characters
 */
class MediumtextResolver extends Resolver
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
