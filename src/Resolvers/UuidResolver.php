<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * UUID
 */
class UuidResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->regexify(\'[a-zA-Z0-9]{36}\'),';
    }

    public function migration(): string
    {
        $migration = '$table->uuid(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
