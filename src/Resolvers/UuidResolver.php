<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * UUID
 */
class UuidResolver extends Resolver implements ResolverInterface
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
