<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * VARCHAR(size)
 *
 * A VARIABLE length string (can contain letters, numbers, and special characters).
 * The size parameter specifies the maximum column length in characters - can be from 0 to 65535
 */
class VarcharResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->paragraph(),';
    }

    public function migration(): string
    {
        // TODO: $table->ipAddress('visitor');
        $migration = '$table->string(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
