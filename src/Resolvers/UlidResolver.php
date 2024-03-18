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
        if (preg_match('/_ulid$/', $this->column->field)) {
            $migration = '$table->foreignUlid(\''.$this->column->field.'\')';
        } else {
            $migration = '$table->ulid(\''.$this->column->field.'\')';
        }

        return $this->last($migration);
    }
}
