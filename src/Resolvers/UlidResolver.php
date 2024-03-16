<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * ULID
 */
class UlidResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->regexify(\'[a-zA-Z0-9]{26}\'),';
    }

    public function migration(): string
    {
        $migration = '$table->ulid(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
