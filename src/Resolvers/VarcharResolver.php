<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * VARCHAR(size)
 *
 * A VARIABLE length string (can contain letters, numbers, and special characters).
 * The size parameter specifies the maximum column length in characters - can be from 0 to 65535
 */
final class VarcharResolver extends Resolver
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
