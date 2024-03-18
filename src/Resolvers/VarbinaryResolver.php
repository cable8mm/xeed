<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * VARBINARY(size)
 *
 * Equal to VARCHAR(), but stores binary byte strings.
 * The size parameter specifies the maximum column length in bytes.
 */
class VarbinaryResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->sentence(),';
    }

    public function migration(): string
    {
        $migration = '$table->char(\''.$this->column->field.'\', '.$this->column->bracket.')';

        return $this->last($migration);
    }
}
